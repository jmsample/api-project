<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\Service\ApiService;
use JournalMedia\Sample\View\ArticlesView;
use JournalMedia\Sample\Service\LocalService;

class TagRiverController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $service = getenv('DEMO_MODE') ? new LocalService() : new ApiService();
        $service->setTag($args['tag']);

        return new HtmlResponse(
            ArticlesView::display($service->fetch(), $service->getTag())
        );
    }
}