<?php
namespace JournalMedia\Sample\Interfaces;

interface DataProviderInterface
{
    public function getByPublication(string $publication);
    public function getByTag(string $tag);
}