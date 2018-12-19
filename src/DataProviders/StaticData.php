<?php
declare(strict_types=1);

namespace JournalMedia\Sample\DataProviders;
use JournalMedia\Sample\Interfaces\DataProviderInterface;

class StaticData implements DataProviderInterface
{
    private $staticDataPath = __DIR__ . '/../../resources/demo-responses/';

    public function __construct()
    {
        $this->staticDataPath = getenv('DATA_PATH');
    }

    public function getData($tag = false)
    {
        $path = __DIR__ . $this->staticDataPath . ($tag ? $tag : 'thejournal') . '.json';
        if (file_exists($path)) {
            if($res = json_decode(file_get_contents($path), true)){
                return $res;
            }
        }
        return array();
    }
}
