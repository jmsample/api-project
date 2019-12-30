<?php
declare(strict_types=1);
namespace JournalMedia\Sample\Classes;
use JournalMedia\Sample\Interfaces\DataProviderInterface;
use JournalMedia\Sample\Classes\StaticContentProvider;
use JournalMedia\Sample\Classes\APIProvider;

Class DataProvider implements DataProviderInterface 
{
    const VALID_PUBLICATION_NAMES = ['thejournal','thescore','thedailyedge','businessetc'];
    private $data_object;

    function __construct() {
        $this->data_object = (getenv('DEMO_MODE') === 'true') ? new StaticContentProvider() : new APIProvider(); 
    }

    public function getProvider() {
        return $this->data_object;
    }

    public function getByPublication(string $publication)
    {
        try {
            if (!in_array($publication,self::VALID_PUBLICATION_NAMES)) {
                throw new \Exception('Invalid publication name!');
            }
            return $this->data_object->getByPublication($publication);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getByTag(string $tag)
    {
        try {
            return $this->data_object->getByTag($tag);
        } catch (\Exception $e) {
            return [];
        } 
    }
}