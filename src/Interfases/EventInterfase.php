<?php

namespace Dda2543\FileChecker\Interfases;

use Dda2543\FileChecker\FileChecker;

interface EventInterfase
{

    public static function getName(): string;
    public function setFileChecker(FileChecker $FileChecker);
}
