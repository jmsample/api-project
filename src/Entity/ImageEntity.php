<?php


namespace JournalMedia\Sample\Entity;

/**
 * Class ImageEntity
 *
 * @package JournalMedia\Sample\Entity
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ImageEntity
{
    /** @var string $name */
    protected $name;

    /** @var string $url */
    protected $url;

    /** @var float $width */
    protected $width;

    /** @var float $height */
    protected $height;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ImageEntity
     */
    public function setName(string $name): ImageEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return ImageEntity
     */
    public function setUrl(string $url): ImageEntity
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     * @return ImageEntity
     */
    public function setWidth(float $width): ImageEntity
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     * @return ImageEntity
     */
    public function setHeight(float $height): ImageEntity
    {
        $this->height = $height;
        return $this;
    }
}