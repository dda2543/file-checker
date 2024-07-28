<?php

namespace Dda2543\FileChecker\Entityes;

use Iterator;

class IncludeExtensionList extends BaseList
{
    public function reset(): void
    {
        $this->position = 0;
        $this->array = [];
    }

    public function set(array $array)
    {
        $this->array = array_unique(array_values($array));

        return $this;
    }

    public function delete(string $value)
    {
        $index = array_search($value, $this->array);
        if ($index !== false) {
            array_splice($this->array, $index, 1);
        }

        return $this;
    }

    public function add(string $value)
    {
        if (!array_search($value, $this->array)) {
            $this->array[] = $value;
        }
        
        return $this;
    }
}
