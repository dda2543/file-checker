<?php

namespace Dda2543\FileCheker\Events;

use Dda2543\FileCheker\FileCheker;
use Dda2543\FileCheker\Interfases\EventInterfase;

abstract class Event implements EventInterfase{
    /**
     * Соступ к основному классу проверки изменения файлов
     *
     * @var FileCheker
     */
    public $fileCheker;

    abstract public static function getName():string;
    
    public function setFileCheker(FileCheker $fileCheker){
        $this->fileCheker = $fileCheker;
        return $this;
    }
}