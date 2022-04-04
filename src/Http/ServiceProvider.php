<?php

namespace JournalMedia\Sample\ApiProject\Http;

use Illuminate\Container\Container;

interface ServiceProvider
{
    public function register(Container $container): void;
}
