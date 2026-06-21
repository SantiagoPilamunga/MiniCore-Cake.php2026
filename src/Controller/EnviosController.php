<?php
namespace App\Controller;

require_once __DIR__ . '/../../config/conexion.php';

class EnviosController 
{
    public function reporte()
    {
        // Capturar los parámetros del formulario GET
        $fechaInicio = $_GET['fecha_inicio'] ?? null;
        $fechaFin = $_GET['fecha_fin'] ?? null;
        $resultados = [];

        if ($fechaInicio && $fechaFin) {
            $pdo = \Config\Database::conectar();

            // CONSULTA RELACIONAL (Mapeo del Modelo)
            // Trae todos los repartidores y calcula sus envíos en el rango de fechas
            $sql = "SELECT r.id_repartidor, r.nombre, 
                           COUNT(e.id_envio) as total_envios,
                           SUM(e.peso_kg) as total_peso
                    FROM repartidores r
                    LEFT JOIN envios e ON r.id_repartidor = e.id_repartidor 
                         AND e.fecha_envio BETWEEN :inicio AND :fin
                    GROUP BY r.id_repartidor, r.nombre";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['inicio' => $fechaInicio, 'fin' => $fechaFin]);
            $repartidores = $stmt->fetchAll();

            foreach ($repartidores as $repartidor) {
                $id = $repartidor['id_repartidor'];
                $cantidadEnvios = (int)$repartidor['total_envios'];
                
                $zonasAplicadas = [];
                $costoTotal = 0;

                if ($cantidadEnvios > 0) {
                    // Buscar los detalles de las zonas y pesos para la fórmula matemática
                    $sqlDetalle = "SELECT e.peso_kg, z.nombre_zona, z.tarifa_por_kg 
                                   FROM envios e
                                   JOIN zonas z ON e.id_zona = z.id_zona
                                   WHERE e.id_repartidor = :id AND e.fecha_envio BETWEEN :inicio AND :fin";
                    
                    $stmtDetalle = $pdo->prepare($sqlDetalle);
                    $stmtDetalle->execute(['id' => $id, 'inicio' => $fechaInicio, 'fin' => $fechaFin]);
                    $enviosDetalle = $stmtDetalle->fetchAll();

                    foreach ($enviosDetalle as $envio) {
                        // LÓGICA DEL CÁLCULO REQUERIDA: peso * tarifa
                        $costoTotal += ($envio['peso_kg'] * $envio['tarifa_por_kg']);
                        $zonasAplicadas[] = $envio['nombre_zona'] . " ($" . number_format((float)$envio['tarifa_por_kg'], 2) . ")";
                    }
                }

                $zonasUnicas = !empty($zonasAplicadas) ? implode(', ', array_unique($zonasAplicadas)) : '—';

                $resultados[] = [
                    'nombre' => $repartidor['nombre'],
                    'envios' => $cantidadEnvios,
                    'total_kg' => $cantidadEnvios > 0 ? number_format((float)$repartidor['total_peso'], 2) . ' kg' : '—',
                    'zona' => $zonasUnicas,
                    'costo_total' => $cantidadEnvios > 0 ? '$' . number_format($costoTotal, 2) : 'No aplica'
                ];
            }
        }

        // Cargar la Vista pasando las variables correspondientes
        require_once __DIR__ . '/../../templates/Envios/reporte.php';
    }
}
