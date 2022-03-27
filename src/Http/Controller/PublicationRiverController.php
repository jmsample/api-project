<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use JournalMedia\Sample\ApiProject\Service\RiverDataSource;
use JournalMedia\Sample\ApiProject\View\RiverView;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PublicationRiverController
{
    private RiverDataSource $riverDataSource;

    /**
     * @param RiverDataSource $riverDataSource
     */
    public function __construct(RiverDataSource $riverDataSource)
    {
        $this->riverDataSource = $riverDataSource;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $data = $this->riverDataSource->get()->getArticlesByPublication('thejournal');
            return (new RiverView($data))->getResponse();
        } catch (Exception $e) {
            return new HtmlResponse($e->getMessage());
        }
    }
}
