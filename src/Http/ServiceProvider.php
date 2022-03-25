<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http;

use GuzzleHttp\Client;
use Illuminate\Container\Container;
use JournalMedia\Sample\ApiProject\Connector\JournalApiConnector;
use JournalMedia\Sample\ApiProject\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\ApiProject\Http\Controller\TagRiverController;
use JournalMedia\Sample\ApiProject\Service\RiverApiDataSource;
use JournalMedia\Sample\ApiProject\Service\RiverDataSource;
use JournalMedia\Sample\ApiProject\Service\RiverFileDataSource;
use League\Route\Router;

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

        $container->singleton(PublicationRiverController::class, function ($container) {
            return new PublicationRiverController($container[RiverDataSource::class]);
        });

        $container->singleton(TagRiverController::class, function ($container) {
            return new TagRiverController($container[RiverDataSource::class]);
        });

        $container->singleton(Client::class, function ($container) {
            return new Client();
        });

        $container->singleton(JournalApiConnector::class, function($container) {
            return new JournalApiConnector($_ENV['THE_JOURNAL_API_BASE_URL'], $container[Client::class]);
        });

        $container->singleton(RiverApiDataSource::class, function ($container) {
            return new RiverApiDataSource($container[JournalApiConnector::class]);
        });

        $container->singleton(RiverFileDataSource::class, function ($container) {
            $projectFullPath = __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . '..';
            return new RiverFileDataSource($projectFullPath . DIRECTORY_SEPARATOR . $_ENV['RIVER_DEMO_FILES_RELATIVE_PATH']);
        });

        $container->singleton(RiverDataSource::class, function ($container) {
            return new RiverDataSource(
                $container[RiverApiDataSource::class],
                $container[RiverFileDataSource::class],
                $_ENV['DEMO_MODE'] === 'true'
            );
        });
    }
}
