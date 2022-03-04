<?php

declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\ApiProject\Services\PublicationRiverService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PublicationRiverController
{

    public function __construct(private HttpClientInterface $client, private PublicationRiverService $PublicationRiverService)
    {
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            $this->PublicationRiverService->getFormatedArticles()
        );
    }
}
