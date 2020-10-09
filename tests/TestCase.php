<?php

namespace Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [\Nidhalkratos\CoconutServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('coconut.s3.access_key', 'key');
        $app['config']->set('coconut.s3.secret_key', 'secret');
        $app['config']->set('coconut.s3.bucket', 'bucket');
    }
}
