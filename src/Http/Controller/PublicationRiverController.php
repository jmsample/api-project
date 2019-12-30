<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\Classes\DataProvider;
use JournalMedia\Sample\Views\RiverView;

class PublicationRiverController
{
    private $dataProvider;
    private $publicationName = 'thejournal';

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->dataProvider = new DataProvider();

        $data = $this->dataProvider->getByPublication($this->publicationName);

        return new HtmlResponse(
            (new RiverView($data))->HTML
        );
    }
}
