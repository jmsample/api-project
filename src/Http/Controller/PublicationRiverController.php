<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class PublicationRiverController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            sprintf("Demo Mode: %s", getenv('DEMO_MODE') === "true" ? "ON" : "OFF")
        );
    }
}
