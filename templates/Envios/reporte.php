<?php
/**
 * @var \App\View\AppView $this
 * @var array $resultados
 * @var string|null $fechaInicio
 * @var string|null $fechaFin
 */
?>

<div style="max-width: 900px; margin: 30px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
    <h2 style="color: #2c3e50; border-bottom: 2px solid #34495e; padding-bottom: 10px;">
        Sistema de Logística - Control de Costos de Envíos
    </h2>
    
    <!-- Formulario de Filtro por Fechas (Envía por GET para mantener los datos en la URL) -->
    <form method="GET" action="" style="background: #f8f9fa; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
        <div style="display: flex; gap: 20px; align-items: flex-end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <label for="fecha_inicio" style="display: block; font-weight: 600; margin-bottom: 8px;">Fecha Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required value="<?= htmlspecialchars($fechaInicio ?? '') ?>" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>
            
            <div style="flex: 1; min-width: 200px;">
                <label for="fecha_fin" style="display: block; font-weight: 600; margin-bottom: 8px;">Fecha Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" required value="<?= htmlspecialchars($fechaFin ?? '') ?>" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>
            
            <div>
                <button type="submit" style="background: #3498db; color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: background 0.2s;">
                    Calcular Costos
                </button>
            </div>
        </div>
    </form>

    <!-- Visualización de Resultados en Tabla -->
    <?php if (!empty($fechaInicio) && !empty($fechaFin)): ?>
        <div style="background: #fff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0;">
            <div style="background: #2c3e50; color: white; padding: 15px 20px; font-weight: bold;">
                Reporte de Envíos Periodo: <?= htmlspecialchars($fechaInicio) ?> al <?= htmlspecialchars($fechaFin) ?>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                        <th style="padding: 12px 20px;">Repartidor</th>
                        <th style="padding: 12px 20px;">Envíos</th>
                        <th style="padding: 12px 20px;">Total kg</th>
                        <th style="padding: 12px 20px;">Zona (Tarifa/kg)</th>
                        <th style="padding: 12px 20px; text-align: right;">Costo Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $fila): ?>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 12px 20px; font-weight: 600; color: #1e293b;"><?= htmlspecialchars($fila['nombre']) ?></td>
                            <td style="padding: 12px 20px;"><?= htmlspecialchars($fila['envios']) ?></td>
                            <td style="padding: 12px 20px;"><?= htmlspecialchars($fila['total_kg']) ?></td>
                            <td style="padding: 12px 20px; font-size: 0.9em; color: #64748b;"><?= htmlspecialchars($fila['zona']) ?></td>
                            <td style="padding: 12px 20px; text-align: right; font-weight: bold; color: <?= $fila['costo_total'] === 'No aplica' ? '#94a3b8' : '#27ae60' ?>;">
                                <?= htmlspecialchars($fila['costo_total']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 40px; color: #64748b; background: #f8f9fa; border: 1px dashed #cbd5e1; border-radius: 8px;">
            Por favor, seleccione un rango de fechas en el formulario superior para procesar la información de los repartidores.
        </div>
    <?php endif; ?>
</div>
