<?php

namespace Rhinodontypicus\LetsAds;

use Illuminate\Support\Facades\Facade;

class LetsAdsFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return "letsads";
    }
}
