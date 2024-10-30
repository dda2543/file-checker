<?php

namespace Dda2543\FileChecker\Interfaces;

use Exception;

interface ReadOnlyInterface
{
    public function getReadOnlyProperties(): array;
    public function __get(string $name);
}
