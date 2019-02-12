<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\Http\Controller\TagRiverController;
use JournalMedia\Sample\Repository\ApiRiverRepository;
use JournalMedia\Sample\Repository\DemoRiverRepository;
use JournalMedia\Sample\Repository\RiverRepositoryInterface;
use League\Route\RouteCollection;

class ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(RiverRepositoryInterface::class, function () {
            if(self::isDemo()){
                return new DemoRiverRepository();
            }else{
                return new ApiRiverRepository();
            }
        });

        $container->singleton(RouteCollection::class, function ($container) {
            $route = new RouteCollection;

            $route->get("/", $container[PublicationRiverController::class]);
            $route->get("/{tag}", $container[TagRiverController::class]);

            return $route;
        });
    }

    /**
     * @return bool
     */
    private static function isDemo() {
        return getenv('DEMO_MODE') === 'true';
    }
}
