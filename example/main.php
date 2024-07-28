<?php

namespace Dda2543\FileChecker\Example;

use Dda2543\FileChecker\Events\Event;
use Dda2543\FileChecker\Events\ChangesFound;
use Dda2543\FileChecker\Events\ChangesNotFound;
use Dda2543\FileChecker\Factories\FileCheckerSingleton;

include '../vendor/autoload.php';

$FileChecker = FileCheckerSingleton::getInstance("./test_rootdir/");

// Обработка события серез слушателя
$FileChecker->on(ChangesFound::class, new Listener());

// Обработка события через замыкание
$FileChecker->on(ChangesNotFound::class, function (Event $event) {
    //    echo "Изменений нет!\r\n";
    //var_dump($event->FileChecker->fileList->currentFiles, $event->FileChecker->fileList->previousFiles);
    sleep(1);
});

// Установка списка расшерений файлов, контролируемых на предмет изменения
$FileChecker
    ->includeExtensions
    ->set(['yaml']);
// Запуск цикла контроля за измененитями
$FileChecker->run();
