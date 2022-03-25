<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use JournalMedia\Sample\ApiProject\Service\RiverDataSource;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class TagRiverController
{
    private RiverDataSource $riverDataSource;

    public function __construct(RiverDataSource $riverDataSource)
    {
        $this->riverDataSource = $riverDataSource;
    }
    public function __invoke(
        ServerRequestInterface $request,
        array $args
    ): ResponseInterface {
        $data = $this->riverDataSource->get()->getArticlesByTag($request->getAttribute('tag'));
        print_r($data);
        return new HtmlResponse(
            "Display the contents of the river for the tag '{$args['tag']}'"
        );
    }
}
