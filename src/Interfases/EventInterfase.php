<?php

namespace Dda2543\FileCheker\Interfases;

use Dda2543\FileCheker\FileCheker;

interface EventInterfase{

    public static function getName():string;
    public function setFileCheker(FileCheker $fileCheker);
}