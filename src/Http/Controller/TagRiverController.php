<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Integration\TheJournalIE\Client as TheJournalIeIntegrationClient;
use JournalMedia\Sample\Service\Test;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class TagRiverController
 * @package JournalMedia\Sample\Http\Controller
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TagRiverController extends Controller
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $theJournalIeClient = new TheJournalIeIntegrationClient;
        $articles = $theJournalIeClient->listArticlesByTagName($args['tag']);

        dd($articles);

        return new HtmlResponse(
            sprintf("Display the contents of the river for the tag '%s'", $args['tag'])
        );
    }
}
