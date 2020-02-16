<?php

namespace JournalMedia\Sample\Repository;

/**
 * interface RiverRepositoryInterface .
 */
interface RiverRepositoryInterface
{
    /**
     * @return array
     */
    public function getPublications(string $slug=null):array ;
}
?>