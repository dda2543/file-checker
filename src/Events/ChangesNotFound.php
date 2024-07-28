<?php

namespace Dda2543\FileChecker\Events;

class ChangesNotFound extends Event
{

    public static function getName(): string
    {
        return 'FileChecker.chang.not_found';
    }
}
