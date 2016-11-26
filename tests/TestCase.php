<?php

namespace Rhinodontypicus\LetsAds\Test;

use Dotenv\Dotenv;
use InvalidArgumentException;
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
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $env = new Dotenv(realpath(__DIR__ . '/../'));
        try {
            $env->load();
        } catch (InvalidArgumentException $e) {
            die("Env file not loaded");
        }

        $app['config']->set('letsads.login', env('LETSADS_LOGIN'));
        $app['config']->set('letsads.password', env('LETSADS_PASSWORD'));
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