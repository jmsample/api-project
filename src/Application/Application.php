<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Application;

use Dotenv\Dotenv;
use Illuminate\Container\Container;

final class Application
{
    private readonly Container $container;

    public function __construct()
    {   
        self::loadEnvironmentVariables();

        $this->container = new Container();
        self::registerServiceProviders($this->container);
    }

    private static function registerServiceProviders(Container $container): void
    {
        (new \JournalMedia\Sample\ApiProject\Http\ServiceProvider)->register($container);
    }

    private static function loadEnvironmentVariables(): void
    {
        (Dotenv::createImmutable(__DIR__ . "/../../"))->load();
    }

    public function make(string $class): mixed
    {
        return $this->container->make($class);
    }
}
