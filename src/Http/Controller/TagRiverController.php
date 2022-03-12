<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use JournalMedia\Sample\ApiProject\Service\NewsProviderService;
use JournalMedia\Sample\ApiProject\Service\StaticContentProviderService;
use JournalMedia\Sample\ApiProject\Transformer\HtmlTransformer;
use Symfony\Component\HttpClient\HttpClient;

final class TagRiverController
{
    public function __invoke(
        ServerRequestInterface $request,
        array $args
    ): ResponseInterface {

        $service = new NewsProviderService(
            HttpClient::create(),
            new StaticContentProviderService(),
            new HtmlTransformer()
        );
        $content = $service->getNewsContent($args['tag']);
        return new HtmlResponse(
            $content
        );
    }
}
