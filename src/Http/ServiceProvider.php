<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\ApiProject\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\ApiProject\Http\Controller\TagRiverController;
use League\Route\Router;

use JournalMedia\Sample\ApiProject\Repository\River\RiverRepositoryInterface;
use JournalMedia\Sample\ApiProject\Repository\River\RemoteRiverRepository;
use JournalMedia\Sample\ApiProject\Repository\River\LocalRiverRepository;

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

        $container->bind( RiverRepositoryInterface::class, $this->getClass( LocalRiverRepository::class, RemoteRiverRepository::class ) );
    }

    private function getClass( string $demoClass, string $prodClass )
    {
        return $_ENV["DEMO_MODE"] === "true" ? $demoClass : $prodClass;
    }
}
