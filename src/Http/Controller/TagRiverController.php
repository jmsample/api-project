<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use JournalMedia\Sample\ApiProject\Services\ArticleService;
use JournalMedia\Sample\ApiProject\Helpers\TwigHelper;

final class TagRiverController
{
    private ArticleService $articleService;
    private TwigHelper $twig;

    public function __construct(ArticleService $articleService, TwigHelper $twig)
    {
        $this->articleService = $articleService;
        $this->twig = $twig;
    }
    
    public function __invoke(
        ServerRequestInterface $request,
        array $args
    ): ResponseInterface {
        $tag = $args['tag'];
        $articles = $this->articleService->getArticlesByTag($tag);
        return $this->twig->render('articles', ['articles' => $articles]);
    }
}
