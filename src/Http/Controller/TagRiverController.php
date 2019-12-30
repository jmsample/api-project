<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\Classes\DataProvider;
use JournalMedia\Sample\Views\RiverView;

class TagRiverController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $this->dataProvider = new DataProvider();
        $data = $this->dataProvider->getByTag($args['tag']);
        return new HtmlResponse(
            (new RiverView($data))->HTML
        );
    }
}
