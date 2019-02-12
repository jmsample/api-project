<?php

namespace JournalMedia\Sample\Model;


use stdClass;

class Article implements \JsonSerializable
{
    private $title;
    private $excerpt;
    private $images;
    private $type;

    /**
     * @return ?string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param ?string $title
     * @return Article
     */
    public function setTitle(?string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    /**
     * @param ?string $excerpt
     * @return Article
     */
    public function setExcerpt(?string $excerpt): Article
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    /**
     * @return StdClass
     */
    public function getImages(): ?\StdClass
    {
        return $this->images;
    }

    /**
     * @param StdClass $images
     * @return Article
     */
    public function setImages(?\StdClass $images): Article
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?string $type
     * @return Article
     */
    public function setType(?string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * JSON implementation serializer
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'excerpt' => $this->getExcerpt(),
            'images' => $this->getImages(),
            'type' => $this->getType()
        ];
    }
}
