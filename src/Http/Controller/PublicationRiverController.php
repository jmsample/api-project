<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Service\ApiService;
use JournalMedia\Sample\Service\LocalService;
use JournalMedia\Sample\View\ArticlesView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class PublicationRiverController
{
    public function __invoke(
        ServerRequestInterface $request): ResponseInterface
    {
        $service = getenv('DEMO_MODE') ? new LocalService() : new ApiService();

        return new HtmlResponse(
            ArticlesView::display($service->fetch())
        );
    }
}
