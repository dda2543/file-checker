<?php

namespace Dda2543\FileCheker\Example;

use Dda2543\FileCheker\Events\ChangesFound;
use Dda2543\FileCheker\Events\ChangesNotFound;
use Dda2543\FileCheker\Events\Event;
use Dda2543\FileCheker\Factories\FileChekerSingleton;

include '../vendor/autoload.php';

$fileCheker = FileChekerSingleton::getInstance("./test_rootdir/");

// Обработка события серез слушателя
$fileCheker->on(ChangesFound::class, new Listener());

// Обработка события через замыкание
$fileCheker->on(ChangesNotFound::class, function(Event $event){
//    echo "Изменений нет!\r\n";
    //var_dump($event->fileCheker->fileList->currentFiles, $event->fileCheker->fileList->previousFiles);
    sleep(1);
});

// Установка списка расшерений файлов, контролируемых на предмет изменения
$fileCheker->includeExtensions->set(['yaml']);
// Запуск цикла контроля за измененитями
$fileCheker->run();