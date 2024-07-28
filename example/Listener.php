<?php

namespace Dda2543\FileChecker\Example;

use Dda2543\FileChecker\Events\ChangesFound;
use Dda2543\FileChecker\Listener as FileCheckerListener;

class Listener extends FileCheckerListener
{

    /**
     * Обработчик событий
     *
     * @param \Dda2543\FileChecker\Events\ChangesFound $event
     *
     * @return void
     */
    public function handler($event)
    {
        $diff = $event->diff;
        $countNew = count($diff->newFiles);
        $countDeleted = count($diff->deletedFiles);
        $countChanged = count($diff->changedFiles);

        echo "Найдены изменения:\r\n";

        echo "\t$countNew\t - создано новых файлов.\r\n";
        if ($countNew) {
            var_dump(array_keys($diff->newFiles));
        }

        echo "\t$countDeleted\t - удалено файлов.\r\n";
        if ($countDeleted) {
            var_dump(array_keys($diff->deletedFiles));
        }

        echo "\t$countChanged\t - изменено файлов.\r\n";
        if ($countChanged) {
            var_dump(array_keys($diff->changedFiles));
        }

        echo "\r\n";
    }
}
