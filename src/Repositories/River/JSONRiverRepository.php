<?php

namespace JournalMedia\Sample\ApiProject\Repositories\River;

class JSONRiverRepository implements RiverRepositoryInterface
{
    public function getRiver()
    {
        $file = file_get_contents($_ENV['JSON_PATH'] . $_ENV['THE_JOURNAL_JSON_PATH']);
        return json_decode($file);
    }

    public function getRiverByTag(string $tag)
    {
        return json_decode($this->getFile($_ENV['JSON_PATH'] . $tag . ".json"));
    }

    private function getFile(string $path) :string {
        return (file_exists($path)) ? file_get_contents($path) : '[]';
    }
}