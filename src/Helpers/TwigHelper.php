<?php

namespace JournalMedia\Sample\ApiProject\Helpers;

use Laminas\Diactoros\Response\HtmlResponse;
use JournalMedia\Sample\ApiProject\Helpers\PathHelper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class TwigHelper
{
    private $twig;
    
    public function __construct()
    {
        $loader = new FilesystemLoader(PathHelper::publicPath() . '/views');
        $this->twig = new Environment($loader);
    }

    /**
     * @param string $view The view file to load
     * @param array $viewData The data to pass to the view
     */
    public function render(string $view, $viewData = []): HtmlResponse
    {
        if (is_null($viewData)) {
            $viewData = [];
        }
        
        return new HtmlResponse(
            sprintf($this->twig->render("{$view}.html.twig", $viewData))
        );
    }
}
