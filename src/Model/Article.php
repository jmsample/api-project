<?php

namespace JournalMedia\Sample\Model;

class Article 
{
    private $title;
    private $excerpt;
    private $image;

    function __construct($title,$excerpt,$image) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->image = $image;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(?string $excerpt)
    {
        $this->excerpt = $excerpt;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image) 
    {
        $this->image = $image; 
    }
}