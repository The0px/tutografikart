<?php

namespace Tests\Unit;

use App\Weather;
use Illuminate\Cache\Repository;
use Mockery;
use Override;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    #[Override]
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function test_example(): void
    {
        $cache = Mockery::mock(Repository::class);
        $cache->shouldReceive('get')
            ->with('weather')
            ->once()
            ->andReturn(null);

        $weather = new Weather($cache);

        $this->assertTrue($weather->isSunnyTomorrow());
    }

    public function test_example_false(): void
    {
        $cache = Mockery::mock(Repository::class);
        $cache->shouldReceive('get')
            ->with('weather')
            ->once()
            ->andReturn(false);

        $weather = new Weather($cache);

        $this->assertFalse($weather->isSunnyTomorrow());
    }
}
