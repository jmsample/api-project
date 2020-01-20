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
class PublicationRiverController extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @return HtmlResponse
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(ServerRequestInterface $request): HtmlResponse
    {
        $publicationName = $request->getAttribute('publication_name', 'thejournal');
        $theJournalIeClient = new TheJournalIeIntegrationClient;
        $articles = $theJournalIeClient->listArticles($publicationName);

        return $this->view('articles.twig', [
            'articles' => $articles
        ]);
    }
}
