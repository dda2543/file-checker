<?php

namespace Dda2543\FileChecker\Events;

use Dda2543\FileChecker\FileChecker;
use Dda2543\FileChecker\Interfaces\EventInterface;

abstract class Event implements EventInterface
{
    /**
     * Соступ к основному классу проверки изменения файлов
     *
     * @var FileChecker
     */
    public $FileChecker;

    abstract public static function getName(): string;

    public function setFileChecker(FileChecker $FileChecker)
    {
        $this->FileChecker = $FileChecker;
        return $this;
    }
}
