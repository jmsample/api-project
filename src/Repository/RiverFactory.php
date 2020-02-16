<?php

namespace JournalMedia\Sample\Repository;

abstract class RiverFactory
{
    public static function createRiverRepository($type): RiverFactory
    {
        switch ($type) {
            case 'STATIC':
                $path = getenv('DEMO_RESOURCE_PATH');
                $homeFile = getenv('DEMO_JOURNAL_FILE');
                return new DemoRiverRepository($path, $homeFile);
                break;
            case 'API':
                $url = getenv('API_URL');
                $pass = getenv('API_PASS');
                $userName = getenv('API_USERNAME');
                return new ApiRiverRepository($url, $userName, $pass);
                break;
        }
        throw new \InvalidArgumentException();
    }
}