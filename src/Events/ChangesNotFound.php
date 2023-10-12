<?php

namespace Dda2543\FileCheker\Events;

class ChangesNotFound extends Event{

    public static function getName(): string
    {
        return 'filecheker.chang.not_found';
    }
}