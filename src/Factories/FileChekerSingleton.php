<?php

namespace Dda2543\FileCheker\Factories;

use Dda2543\FileCheker\FileCheker;

final class FileChekerSingleton{
    static private $instance = null;

    static public function getInstance($rootDir = "./"):FileCheker
    {
        if(self::$instance===null) self::$instance = new FileCheker($rootDir);
        return self::$instance;
    }
}