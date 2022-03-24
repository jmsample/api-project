<?php

namespace JournalMedia\Sample\ApiProject\Repositories\River;

interface RiverRepositoryInterface
{
    public function getRiver();
    public function getRiverByTag(string $tag);
}