<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Application;
use JournalMedia\Sample\DataProviders\Api;
use JournalMedia\Sample\DataProviders\StaticData;

class DataProvider
{
    private $provider;

    public function __construct()
    {
        $this->provider = $this::getProvider();
    }

    public static function getProvider(){
        return getenv('DEMO_MODE') == 'true' ? new StaticData() : new Api();
    }

    public function getData($tag){
        return $this->provider->getData($tag);
    }
}
