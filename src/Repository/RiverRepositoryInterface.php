<?php

namespace JournalMedia\Sample\Repository;

interface RiverRepositoryInterface
{
    public function getForPublication();

    public function getForTag(string $tag);
}