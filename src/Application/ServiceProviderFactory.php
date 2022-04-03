<?php

namespace JournalMedia\Sample\ApiProject\Application;

use JournalMedia\Sample\ApiProject\Http\ProdServiceProvider;
use JournalMedia\Sample\ApiProject\Http\ServiceProvider;
use JournalMedia\Sample\ApiProject\Http\TestServiceProvider;

final class ServiceProviderFactory
{
    public static function getServiceProvider(bool $demoMode): ServiceProvider {

        if ($demoMode) {
            return new TestServiceProvider();
        }

        return new ProdServiceProvider();
    }
}
