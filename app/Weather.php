<?php

namespace App;

use Illuminate\Cache\Repository;

class Weather
{
    public function __construct(private Repository $cache) {}

    public function isSunnyTomorrow(): bool
    {
        return $this->cache->get('weather') ?? true;
    }
}
