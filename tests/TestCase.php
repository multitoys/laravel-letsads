<?php

namespace Rhinodontypicus\LetsAds\Test;

use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Set Up
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Rhinodontypicus\LetsAds\LetsAdsServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'LetsAds' => \Rhinodontypicus\LetsAds\LetsAdsFacade::class,
        ];
    }
}