<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\ApiProject\Application\HomePageRiverClient;
use JournalMedia\Sample\ApiProject\Application\HomepageRiverRepository;
use JournalMedia\Sample\ApiProject\Application\PostProcessor;
use JournalMedia\Sample\ApiProject\Application\RemoteClient;
use JournalMedia\Sample\ApiProject\Application\TagRiverClient;
use JournalMedia\Sample\ApiProject\Application\TagRiverRepository;
use JournalMedia\Sample\ApiProject\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\ApiProject\Http\Controller\TagRiverController;
use League\Route\Router;

final class ProdServiceProvider implements ServiceProvider
{
    public function register(Container $container): void
    {
        $container['url'] = "https://api.thejournal.ie/v3/sample/";
        $container['username'] = 'codetest';
        $container['password'] = 'AQJl5jewY2lZkrJpiT1cCJkj1tLPn64R';

        $container->singleton(Router::class, function ($container) {
            $router = new Router;

            $router->get("/", $container[PublicationRiverController::class]);
            $router->get("/{tag}", $container[TagRiverController::class]);

            return $router;
        });

        $container->singleton(HomepageRiverRepository::class, function ($container) {
            return new HomepageRiverRepository($container[HomePageRiverClient::class], new PostProcessor());
        });

        $container->singleton(TagRiverRepository::class, function ($container) {
            return new TagRiverRepository($container[HomePageRiverClient::class], new PostProcessor());
        });

        $container->singleton(HomePageRiverClient::class, function ($container) {
            return $container['client'];
        });

        $container->singleton(TagRiverClient::class, function ($container) {
            return $container['client'];
        });

        $container->singleton('client', function($container) {
            return new RemoteClient($container['url'], $container['username'], $container['password']);
        });
    }
}
