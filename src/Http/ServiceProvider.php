<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\Http\Controller\TagRiverController;
use League\Route\RouteCollection;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class ServiceProvider
 * @package JournalMedia\Sample\Http
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ServiceProvider
{
    public function register(Container $container): void
    {
        $container->singleton(RouteCollection::class, function ($container) {
            $route = new RouteCollection;

            $route->get("/", $container[PublicationRiverController::class]);
            $route->get("/{tag}", $container[TagRiverController::class]);

            return $route;
        });

        $container->singleton(Environment::class, function () {
            $ds = DIRECTORY_SEPARATOR;

            $templatesPath = "{$_SERVER['DOCUMENT_ROOT']}{$ds}..{$ds}views";
            $cachePath = "{$_SERVER['DOCUMENT_ROOT']}{$ds}..{$ds}cache{$ds}views";

            $loader = new FilesystemLoader($templatesPath);
            $twig = new Environment($loader, [
                'cache' => $cachePath,
            ]);

            return $twig;
        });
    }
}
