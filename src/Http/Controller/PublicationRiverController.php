<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use JournalMedia\Sample\ApiProject\Services\ArticleService;
use JournalMedia\Sample\ApiProject\Helpers\TwigHelper;

final class PublicationRiverController
{
    private ArticleService $articleService;
    private TwigHelper $twig;
    
    public function __construct(ArticleService $articleService, TwigHelper $twig)
    {
        $this->articleService = $articleService;
        $this->twig = $twig;
    }
    
    public function __invoke(): ResponseInterface
    {
        $articles = $this->articleService->getArticles();
        return $this->twig->render('articles', ['articles' => $articles]);
    }
}
