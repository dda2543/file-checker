<?php

namespace Dda2543\FileChecker\Entityes;

use Iterator;

class DiffFileList
{
    public $newFiles     = [];
    public $deletedFiles = [];
    public $changedFiles = [];

    public function addNewFile(FileInfo $file)
    {
        $this->newFiles[$file->filePath] = $file;
    }

    public function addDeletedFile(FileInfo $file)
    {
        $this->deletedFiles[$file->filePath] = $file;
    }

    public function addChangedFile(FileInfo $file)
    {
        $this->changedFiles[$file->filePath] = $file;
    }

    public function isEmpty(): bool
    {
        return (
            empty($this->changedFiles) &&
            empty($this->newFiles) &&
            empty($this->deletedFiles)
        );
    }

    static function isChanged(FileInfo $oldInfo, FileInfo $newInfo)
    {
        $propertyes = [
            'size',
            'mtime',
            'atime',
            'ctime',
            'uid',
            'gid',
            'dev',
        ];
        foreach ($propertyes as $property) {
            if ($oldInfo->$property !== $newInfo->$property) {
                return true;
            }
        }

        return false;
    }
}
