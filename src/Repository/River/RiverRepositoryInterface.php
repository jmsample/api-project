<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Repository\River;

/**
 * Definition for RiverRepositoryInterface 
 */
interface RiverRepositoryInterface 
{
    public function getPublication() : array | null;
    public function getTag( string $tag ) : array | null;
}