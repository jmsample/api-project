<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use JournalMedia\Sample\ApiProject\Service\RiverDataSource;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class PublicationRiverController
{
    private RiverDataSource $riverDataSource;
    private string $publication;

    public function __construct(RiverDataSource $riverDataSource, string $publication = 'thejournal')
    {
        $this->riverDataSource = $riverDataSource;
        $this->publication = $publication;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->riverDataSource->get()->getArticlesByPublication($this->publication);
        print_r($data);
        return new HtmlResponse(
            sprintf("Demo Mode: %s", $_ENV['DEMO_MODE'] === "true" ? "ON" : "OFF")
        );
    }
}
