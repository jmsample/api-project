<?php

namespace JournalMedia\Sample\ApiProject\Service;

class RiverDataSource
{
    private bool $isDemoMode;
    private RiverApiDataSource $riverApiDataSource;
    private RiverFileDataSource $riverFileDataSource;

    public function __construct(
        RiverApiDataSource $riverApiDataSource,
        RiverFileDataSource $riverFileDataSource,
        bool $isDemoMode = true)
    {

        $this->isDemoMode = $isDemoMode;
        $this->riverApiDataSource = $riverApiDataSource;
        $this->riverFileDataSource = $riverFileDataSource;
    }

    public function get(): RiverDataSourceInterface
    {
        if ($this->isDemoMode) {
            return $this->riverFileDataSource;
        } else {
            return $this->riverApiDataSource;
        }
    }
}