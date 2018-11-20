<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use JournalMedia\Sample\Application\Api;

class PublicationRiverController {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response;
    }

    public function loadView(Request $request): Response
    {
        $view  =  require_once(__DIR__ . '/../../../resources/views/articles.php');
        return new HtmlResponse($view);
    }

    public function getArticles(Request $request): Response {
        return new JsonResponse((new Api)->getArticles());
    }
}
