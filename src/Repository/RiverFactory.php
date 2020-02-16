<?php

namespace JournalMedia\Sample\Repository;

abstract class RiverFactory
{
    public static function createRiverRepository($type='STATIC',$params=[]): RiverFactory
    {
        switch ($type) {
            case 'STATIC':
                return new DemoRiverRepository($params);
                break;
            case 'API':
                return new ApiRiverRepository($params);
                break;
        }
        throw new \InvalidArgumentException();
    }
}