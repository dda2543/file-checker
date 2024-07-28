<?php

namespace Dda2543\FileChecker\Events;

use Dda2543\FileChecker\Entityes\DiffFileList;

class ChangesFound extends Event{
    public $diff;
    public $deletedFiles = [];
    public $changedFiles = [];
    
    /**
     * Class constructor.
     */
    public function __construct(DiffFileList $diff)
    {
        $this->diff = $diff;
    }

    public static function getName():string{
        return 'FileChecker.chang.found';
    }
}