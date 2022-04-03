<?php

namespace JournalMedia\Sample\ApiProject\Application;

final class HtmlFromPostsBuilder
{
    public function buildHtml(array $posts): string {
        return implode(array_map(function(Post $post) {
            return $this->getTitle($post) . $this->getExcerpt($post) . $this->getImage($post);
        }, $posts));
    }

    private function getImage(Post $post):string {
        $thumbnailUrl = $post->getImages()['thumbnail']['image'];
        return '<img src="' . $thumbnailUrl . '"/>';
    }

    private function getTitle(Post $post): string {
        return "<h1>" . $post->getTitle() . "</h1>";
    }

    private function getExcerpt(Post $post) {
        return "<h3>" . $post->getExcerpt() . "</h3>";
    }
}
