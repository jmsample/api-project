<?php

namespace JournalMedia\Sample\ApiProject\Helpers;

use \JsonException;
use \Exception;

class JsonHelper
{
    /**
     * @param string $json
     */
    public function toJson(string $json): array
    {
        try {
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        }
        catch (JsonException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
