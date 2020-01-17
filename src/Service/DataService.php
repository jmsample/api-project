<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 2020-01-16
 * Time: 17:06
 */

namespace JournalMedia\Sample\Service;

use JournalMedia\Sample\Validator\PublicationValidator;
use JournalMedia\Sample\Validator\TagValidator;

/**
 * Class DataService
 * @package JournalMedia\Sample\Service
 */
abstract class DataService
{
    /**
     * @var string
     */
    public $tag;

    /**
     * @var string
     */
    public $publication;

    /**
     * DataService constructor.
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = TagValidator::validate($tag) ? $tag : null;
    }

    /**
     * @return mixed
     */
    public function getPublication()
    {
        // By default if publication is not set we return thejournal
        if (empty($this->publication)) {
            return "thejournal";
        }

        return $this->publication;
    }

    /**
     * @param mixed $publication
     */
    public function setPublication($publication)
    {
        $this->publication = PublicationValidator::validate($publication) ? $publication : null;
    }
}