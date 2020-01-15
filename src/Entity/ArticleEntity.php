<?php


namespace JournalMedia\Sample\Entity;

use JournalMedia\Sample\Entity\Enum\ArticleTypeEnum;

/**
 * Class ArticleEntity
 * @package JournalMedia\Sample\Entity
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ArticleEntity
{
    /** @var string $title Title of the article. */
    protected $title;

    /** @var string $excerpt A short description of the article. */
    protected $excerpt;

    /** @var ImageEntity[] $images List of images in the articles. */
    protected $images;

    /** @var ArticleTypeEnum $type Type of article. */
    protected $type;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ArticleEntity
     */
    public function setTitle(string $title): ArticleEntity
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    /**
     * @param string $excerpt
     * @return ArticleEntity
     */
    public function setExcerpt(string $excerpt): ArticleEntity
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    /**
     * @return ImageEntity[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param ImageEntity[] $images
     * @return ArticleEntity
     */
    public function setImages(array $images): ArticleEntity
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return ArticleTypeEnum
     */
    public function getType(): ArticleTypeEnum
    {
        return $this->type;
    }

    /**
     * @param ArticleTypeEnum $type
     * @return ArticleEntity
     */
    public function setType(ArticleTypeEnum $type): ArticleEntity
    {
        $this->type = $type;
        return $this;
    }
}