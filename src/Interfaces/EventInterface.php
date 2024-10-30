<?php

namespace Dda2543\FileChecker\Interfaces;

use Dda2543\FileChecker\FileChecker;

interface EventInterface
{
    public static function getName(): string;
    public function setFileChecker(FileChecker $FileChecker);
}
