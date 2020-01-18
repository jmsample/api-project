<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Integration\TheJournalIE\Client as TheJournalIeIntegrationClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class PublicationRiverController
 * @package JournalMedia\Sample\Http\Controller
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class PublicationRiverController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $publicationName = $request->getAttribute('publication_name', 'thejournal');
        $theJournalIeClient = new TheJournalIeIntegrationClient;
        $articles = $theJournalIeClient->listArticles($publicationName);

        dd($articles);

        return new HtmlResponse(
            sprintf("Demo Mode: %s", getenv('DEMO_MODE') === "true" ? "ON" : "OFF")
        );
    }
}
