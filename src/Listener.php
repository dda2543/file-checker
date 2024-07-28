<?php
namespace Dda2543\FileChecker;

use Dda2543\FileChecker\Events\Event;
use Dda2543\FileChecker\Interfases\EventInterfase;

abstract class Listener{

    public function __invoke(Event $event){
        $this->handler($event);
    }

    abstract public function handler( $event );
}