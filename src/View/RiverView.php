<?php

namespace JournalMedia\Sample\ApiProject\View;

use Laminas\Diactoros\Response\HtmlResponse;

class RiverView
{
    private array $articles;

    /**
     * @param array $articles
     */
    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return HtmlResponse
     */
    public function getResponse(): HtmlResponse
    {
        $html = '<html>';
        $html .= '<head></head>';
        $html .= '<body>';
        foreach ($this->articles as $article) {
            $html .= '<div class="article">';
            $html .= "<h3>{$article['title']}</h3>";
            $html .= '<div class="content">';
            $html .= '<div class="thumbnail">';
            $html .= "<img src=\"{$article['images']['thumbnail']['image']}\">";
            $html .= '</div>';
            $html .= '<div class="excerpt">';
            $html .= $article['excerpt'];
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</body>';
        $html .= '</html>';

        return new HtmlResponse($html);
    }
}