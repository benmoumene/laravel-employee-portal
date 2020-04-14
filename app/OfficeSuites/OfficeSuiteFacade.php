<?php

namespace App\OfficeSuites;

use Illuminate\Support\Facades\Facade;

class OfficeSuiteFacade extends Facade
{
    /**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor()
    {
        return 'office_suite';
    }
}