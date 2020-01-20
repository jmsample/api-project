<?php

namespace JournalMedia\Sample\Integration\TheJournalIE\Entity;

/**
 * Class ImageEntity
 *
 * @package JournalMedia\Sample\Entity
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ImageEntity
{
    /** @var string $name Name of the image. */
    protected $name;

    /** @var string $url Url do access the image. */
    protected $url;

    /** @var float $width Width of the image (size). */
    protected $width;

    /** @var float $height Height of the image (size). */
    protected $height;

    /**
     * ImageEntity constructor.
     * @param string $name Name of the image.
     * @param string $url Url do access the image.
     * @param float $width Width of the image (size).
     * @param float $height Height of the image (size).
     */
    public function __construct(string $name, string $url, float $width, float $height)
    {
        $this->name = $name;
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }

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