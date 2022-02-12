<?php

namespace App\Services;

class SuffixService
{
    private $suffix;

    public function __construct()
    {
        $this->suffix = ' bad,bad,bad ';
    }

    public function addSuffix(string $data): string
    {
        return $data . $this->suffix;
    }
}
