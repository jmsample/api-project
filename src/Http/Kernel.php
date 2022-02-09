<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http;

use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Kernel
{
    public function __construct(
        private readonly Router $router
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }
}
