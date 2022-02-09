<?php
declare(strict_types=1);

$app = require_once __DIR__ . "/../bootstrap.php";

$kernel = $app->make(\JournalMedia\Sample\ApiProject\Http\Kernel::class);
$emitter = $app->make(\Laminas\HttpHandlerRunner\Emitter\SapiEmitter::class);

$response = $kernel->handle(
    \Laminas\Diactoros\ServerRequestFactory::fromGlobals()
);

$emitter->emit($response);
