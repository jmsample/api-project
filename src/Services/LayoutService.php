<?php

namespace JournalMedia\Sample\ApiProject\Services;

class LayoutService
{
    public function formatRiver(array $river) :string
    {
        return array_reduce($river, 'self::formatArticle', '');
    }

    private function formatArticle(string|null $carry, $article) :string {

        $carry .= ($article->type === 'post') ?
            '<article>
                <h3>' . $article->title . '</h3>
                <p>' . $article->excerpt . '</p>
                <figure>
                    <img src="'.$article->images->thumbnail->image.'">
                </figure>
            </article>'
        : '';

        return $carry;
    }
}