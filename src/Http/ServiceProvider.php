<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\Http\Controller\RiverController;
use League\Route\RouteCollection;

class ServiceProvider
{
    public function register(Container $container): void
    {
        $container->singleton(RouteCollection::class, function ($container) {
            $route = new RouteCollection;

            $route->get("/", $container[RiverController::class]);
            $route->get("/{tag}", $container[RiverController::class]);

            return $route;
        });
    }
}
