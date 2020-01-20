<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\ServiceProvider;

use Illuminate\Container\Container;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class TwigServiceProvider to register the twig template engine.
 * @package JournalMedia\Sample\Http
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TemplateEngineServiceProvider
{
    public function register(Container $container): void
    {
        $container->singleton(Environment::class, function () {
            $ds = DIRECTORY_SEPARATOR;

            $templatesPath = "{$_SERVER['DOCUMENT_ROOT']}{$ds}..{$ds}views";

            $loader = new FilesystemLoader($templatesPath);
            $twig = new Environment($loader);

            return $twig;
        });
    }
}
