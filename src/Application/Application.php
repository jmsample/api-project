<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Application;

use Dotenv\Dotenv;
use Illuminate\Container\Container;
use JournalMedia\Sample\Http\ServiceProvider\ServiceProvider;
use JournalMedia\Sample\Http\ServiceProvider\TemplateEngineServiceProvider;

/**
 * Class Application
 * @package JournalMedia\Sample\Application
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class Application
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->container = new Container();
        $this->registerServiceProviders();
        $this->loadEnvironmentVariables();
    }

    private function registerServiceProviders(): void
    {
        (new ServiceProvider)->register($this->container);
        (new TemplateEngineServiceProvider)->register($this->container);
    }

    private function loadEnvironmentVariables(): void
    {
        (new Dotenv(__DIR__ . "/../../"))->load();
    }

    public function make(string $class)
    {
        return $this->container->make($class);
    }
}
