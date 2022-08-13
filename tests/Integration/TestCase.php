<?php

namespace Dzaki236\RajaOngkir\Tests\Integration;

use Dzaki236\RajaOngkir\Facades\RajaOngkir;
use Dzaki236\RajaOngkir\Providers\LaravelServiceProvider as RajaOngkirServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            RajaOngkirServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'RajaOngkir' => RajaOngkir::class,
        ];
    }
}
