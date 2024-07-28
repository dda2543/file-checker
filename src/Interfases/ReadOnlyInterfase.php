<?php

namespace Dda2543\FileChecker\Interfases;

use Exception;

interface ReadOnlyInterfase
{

    public function getReadOnlyProperties(): array;
    public function __get(string $name);
}
