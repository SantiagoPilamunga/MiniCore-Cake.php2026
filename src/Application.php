<?php
namespace App;

use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Core\HttpApplicationInterface;

class Application extends BaseApplication implements HttpApplicationInterface
{
    /**
     * Cargar el archivo de rutas inicializando la colección del Router
     */
    public function routes(RouteBuilder $routes): void
    {
        $routes->scope('/', function (RouteBuilder $builder): void {
            // Conectar la raíz directamente a la pantalla del Mini Core solicitado
            $builder->connect('/', ['controller' => 'Envios', 'action' => 'reporte']);
            $builder->fallbacks();
        });
        
        parent::routes($routes);
    }

    /**
     * Configurar los middlewares del ciclo de vida de la solicitud HTTP
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new AssetMiddleware())
            ->add(new RoutingMiddleware($this));

        return $middlewareQueue;
    }
}
