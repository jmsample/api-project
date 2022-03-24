<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\ApiProject\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\ApiProject\Http\Controller\TagRiverController;
use League\Route\Router;
use JournalMedia\Sample\ApiProject\Repositories\River\RiverRepositoryInterface;
use JournalMedia\Sample\ApiProject\Repositories\River\APIRiverRepository;
use JournalMedia\Sample\ApiProject\Repositories\River\JSONRiverRepository;

final class ServiceProvider
{
    public function register(Container $container): void
    {
        $container->singleton(Router::class, function ($container) {
            $router = new Router;

            $router->get("/", $container[PublicationRiverController::class]);
            $router->get("/{tag}", $container[TagRiverController::class]);

            return $router;
        });

        $container->bind(
            RiverRepositoryInterface::class,
            ( $_ENV['DEMO_MODE'] === "true" ) ? JSONRiverRepository::class : APIRiverRepository::class
        );
    }
}
