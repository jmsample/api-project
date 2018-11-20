<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\Http\Controller\TagRiverController;
use League\Route\RouteCollection;

class ServiceProvider
{
    public function register(Container $container): void
    {
        $container->singleton(RouteCollection::class, function ($container) {
            $route = new RouteCollection;

            $appUrl = getenv('APP_URL');

            $route->get("$appUrl/", [new PublicationRiverController, 'loadView']);
            $route->get("$appUrl/articles", [new PublicationRiverController, 'getArticles']);
            $route->get("$appUrl/{tag}", [new TagRiverController, 'loadView']);
            $route->get("$appUrl/articles/{tag}", [new TagRiverController, 'getArticles']);

            return $route;
        });

        return;
    }
}
