<?php
namespace Dda2543\FileCheker;

use Dda2543\FileCheker\Events\Event;
use Dda2543\FileCheker\Interfases\EventInterfase;

abstract class Listener{

    public function __invoke(Event $event){
        $this->handler($event);
    }

    abstract public function handler( $event );
}