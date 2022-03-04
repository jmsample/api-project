<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use JournalMedia\Sample\ApiProject\Services\TagRiverService;

final class TagRiverController
{

    public function __construct(private HttpClientInterface $client, private TagRiverService $tagPublicationRiverService)
    {
    }

    public function __invoke(
        ServerRequestInterface $request,
        array $args
    ): ResponseInterface {

        return new HtmlResponse(
            $this->tagPublicationRiverService->getFormatedArticles($args["tag"])
        );
    }
}
