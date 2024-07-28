<?php

namespace Dda2543\FileChecker\Traits;

use Exception;

trait ReadOnlyTrait
{

    public function __get(string $name)
    {
        if (!in_array($name, $this->getReadOnlyProperties())) {
            throw new Exception("Свойство '$name' не определено.");
        }
        
        return $this->$name;
    }
}
