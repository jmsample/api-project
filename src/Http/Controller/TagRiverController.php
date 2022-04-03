<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use JournalMedia\Sample\ApiProject\Application\HtmlFromPostsBuilder;
use JournalMedia\Sample\ApiProject\Application\TagRiverRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class TagRiverController
{
    private TagRiverRepository $tagRiverRepository;
    private HtmlFromPostsBuilder $htmlFromPostsBuilder;

    public function __construct(TagRiverRepository $tagRiverRepository, HtmlFromPostsBuilder $htmlFromPostsBuilder)
    {
        $this->tagRiverRepository = $tagRiverRepository;
        $this->htmlFromPostsBuilder = $htmlFromPostsBuilder;
    }

    public function __invoke(
        ServerRequestInterface $request,
        array $args
    ): ResponseInterface {

        $posts = $this->tagRiverRepository->getPostsForTag($args['tag']);

        $html = $this->htmlFromPostsBuilder->buildHtml($posts);

        return new HtmlResponse($html);
    }
}
