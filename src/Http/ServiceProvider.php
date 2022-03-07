<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\ApiProject\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\ApiProject\Http\Controller\TagRiverController;
use League\Route\Router;
use JournalMedia\Sample\ApiProject\Services\PublicationRiverService;
use JournalMedia\Sample\ApiProject\Services\TagRiverService;
use JournalMedia\Sample\ApiProject\Services\HelperService;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;
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

        $container->singleton(HttpClientInterface::class, function ($container) {
            $client = HttpClient::create([
            
                // HTTP Basic authentication with a username and a password
                'auth_basic' => [$_ENV["API_USER"], $_ENV["API_PASSWORD"]],
            
            ]);
            return $client;
        });

        $container->singleton(HelperService::class, function ($container) {
            $helperService = new HelperService($container[HttpClientInterface::class],$container[HttpClientInterface::class]); 
            return $helperService;
        });

        $container->singleton(PublicationRiverService::class, function ($container) {
            $PublicationRiverService = new PublicationRiverService($container[HelperService::class]); 
            return $PublicationRiverService;
        });

        $container->singleton(TagRiverService::class, function ($container) {
            $tagService = new TagRiverService($container[HelperService::class]); 
            return $tagService;
        });
    }
}
