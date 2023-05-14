<?php

namespace App\Helpers\Classes;

use Exception;

class ServiceFactory
{
    /**
     * @throws Exception
     */
    public static function build($serviceClass)
    {
        $serviceClassNameSpace = 'App\\Services\\Payment\\' . $serviceClass;
        if (class_exists($serviceClassNameSpace)) {
            return new $serviceClassNameSpace;
        } else {
            throw new Exception("Did not find any service.");
        }
    }
}