<?php

namespace JournalMedia\Sample\View;

/**
 * Just a very basic class to format output on the page
 *
 * Class ArticlesView
 * @package JournalMedia\Sample\View
 */
class ArticlesView
{
    /**
     * Display articles inside a table
     * @param $articles
     */
    public static function display(
        $articles,
        $tag = null
    ) {
        echo "Demo Mode: ", getenv('DEMO_MODE') === "true" ? "ON" : "OFF";
        echo empty($tag) ? "" : "  |  Tag: " . strtoupper($tag);
        echo "<table>";

        if (is_array($articles)) {
            foreach ($articles as $article) {
                if ($article->type == 'post') {
                    echo "<tr>" .
                        "<td valign='top'>" .
                        "<img src='" . $article->images->thumbnail->image . "'" .
                        "alt='" . $article->title . "'>" .
                        "<td>" .
                        "<td valign='top'>" .
                        "<h3>" . $article->title . "</h3>" .
                        $article->excerpt .
                        "</td>" .
                        "</tr>";
                }
            }
        }

        echo "</table>";
    }
}