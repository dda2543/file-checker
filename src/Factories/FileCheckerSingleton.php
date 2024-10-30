<?php

namespace Dda2543\FileChecker\Factories;

use Dda2543\FileChecker\FileChecker;

final class FileCheckerSingleton
{
    private static $instance = null;

    public static function getInstance($rootDir = "./"): FileChecker
    {
        if (self::$instance === null) {
            self::$instance = new FileChecker($rootDir);
        }

        return self::$instance;
    }
}
