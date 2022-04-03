<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use JournalMedia\Sample\ApiProject\Application\HtmlFromPostsBuilder;
use JournalMedia\Sample\ApiProject\Application\HomepageRiverRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

final class PublicationRiverController
{
    private HomepageRiverRepository $postRepository;
    private HtmlFromPostsBuilder $htmlFromPostsBuilder;

    public function __construct(HomepageRiverRepository $postRepository, HtmlFromPostsBuilder $htmlFromPostsBuilder)
    {
        $this->postRepository = $postRepository;
        $this->htmlFromPostsBuilder = $htmlFromPostsBuilder;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $posts = $this->postRepository->getPosts("thejournal");

        $html = $this->htmlFromPostsBuilder->buildHtml($posts);

        return new HtmlResponse($html);
    }
}
