<?php

namespace Dda2543\FileCheker\Events;

use Dda2543\FileCheker\Entityes\DiffFileList;

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
        return 'filecheker.chang.found';
    }
}