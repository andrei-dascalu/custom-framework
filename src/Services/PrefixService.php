<?php

namespace App\Services;

class PrefixService
{
    private $prefix;

    public function __construct(private SuffixService $suffixService)
    {
        $this->prefix = ' ok ';
    }

    public function addPrefix(string $data): string
    {
        return $this->prefix . $data;
    }

    public function addBoth(string $data): string {
        return $this->addPrefix($this->suffixService->addSuffix($data));
    }
}
