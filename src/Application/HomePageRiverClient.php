<?php

namespace JournalMedia\Sample\ApiProject\Application;

interface HomePageRiverClient
{
    public function requestHomePageRiver(string $identifier): string;
}
