<?php

namespace Dda2543\FileCheker\Example;

use Dda2543\FileCheker\Events\ChangesFound;
use Dda2543\FileCheker\Listener as FileChekerListener;

class Listener extends FileChekerListener{

    /**
     * Обработчик событий
     *
     * @param \Dda2543\FileCheker\Events\ChangesFound $event
     *
     * @return void
     */
    public function handler($event)
    {
        $countNew = count( $event->diff->newFiles);
        $countDeleted = count( $event->diff->deletedFiles);
        $countChanged = count( $event->diff->changedFiles);

        echo "Найдены изменения:\r\n";
        echo "\t$countNew\t - создано новых файлов.\r\n";
        if($countNew) var_dump(array_keys( $event->diff->newFiles ));
        echo "\t$countDeleted\t - удалено файлов.\r\n";
        if($countDeleted) var_dump(array_keys( $event->diff->deletedFiles ));
        echo "\t$countChanged\t - изменено файлов.\r\n";
        if($countChanged) var_dump(array_keys( $event->diff->changedFiles ));
        echo "\r\n";
        
    }
}