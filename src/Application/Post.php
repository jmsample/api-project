<?php

namespace JournalMedia\Sample\ApiProject\Application;

final class Post
{
    private string $title;
    private string $excerpt;
    private array $images;
    private string $type;

    public function __construct(string $title, string $excerpt, array $images, string $type)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->images = $images;
        $this->type = $type;
    }

    public static function fromArray(array $article): Post {
        return new Post($article['title'], $article['excerpt'], $article['images'], $article['type']);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

}
