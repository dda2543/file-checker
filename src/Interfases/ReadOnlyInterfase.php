<?php
namespace Dda2543\FileCheker\Interfases;

use Exception;

interface ReadOnlyInterfase{

    public function getReadOnlyProperties():array;
    public function __get(string $name);
}