<?php

namespace Amethyst\Tests;

use Illuminate\Support\Facades\File;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected static $setup = false;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        if (static::$setup === true) {
            return true;
        }

        static::$setup = true;

        File::cleanDirectory(database_path('migrations/'));

        $this->artisan('vendor:publish', [
            '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
        ]);

        $this->artisan('migrate:fresh');
        $this->artisan('amethyst:invoice:install');
    }

    protected function getPackageProviders($app)
    {
        return [
            \Amethyst\Providers\ContractServiceProvider::class,
        ];
    }
}
