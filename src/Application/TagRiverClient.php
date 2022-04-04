<?php

namespace JournalMedia\Sample\ApiProject\Application;

interface TagRiverClient
{
    public function requestTagRiver(string $identifier): string;
}
