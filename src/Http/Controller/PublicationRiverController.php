<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class PublicationRiverController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            sprintf("Demo Mode: %s", getenv('DEMO_MODE') === "true" ? "ON" : "OFF")
        );
    }
}
