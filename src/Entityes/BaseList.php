<?php

namespace Dda2543\FileChecker\Entityes;

use Countable;
use Iterator;

abstract class BaseList implements Iterator, Countable{
    protected $position = 0;
    protected $array = [];

    public function __construct() {
        $this->position = 0;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current() {
        return $this->array[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->array[$this->position]);
    }

    public function count(): int
    {
        return count($this->array);
    }

    public function toArray():array{
        return $this->array;
    }

}