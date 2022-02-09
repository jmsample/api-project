<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class TagRiverController
{
    public function __invoke(
        ServerRequestInterface $request,
        array $args
    ): ResponseInterface {
        return new HtmlResponse(
            "Display the contents of the river for the tag '{$args['tag']}'"
        );
    }
}
