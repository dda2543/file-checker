<?php

namespace Dda2543\FileCheker\Entityes;

use Dda2543\FileCheker\Interfases\ReadOnlyInterfase;
use Dda2543\FileCheker\Traits\ReadOnlyTrait;
use Exception;
use Iterator;
/**
 * Хранилище состояния файлов
 * 
 * @property-read FileInfo[] $currentFiles  Текущий список файлов
 * @property-read FileInfo[] $previousFiles Предыдущий список файлов
 */
class FileLists implements ReadOnlyInterfase{
    use ReadOnlyTrait;

    private $currentFiles;
    private $previousFiles;

    public function getReadOnlyProperties():array{
        return [
            'currentFiles',
            'previousFiles'
        ];
    }

    public function resertCurrentFiles(){
        $this->previousFiles = $this->currentFiles;
        $this->currentFiles = [];

        return $this;
    }

    public function add(FileInfo $fileInfo){
        if(isset($this->currentFiles[$fileInfo->filePath])) throw new Exception('Попытка дважды добавить один и тот же файл!:'.$fileInfo->filePath);
        $this->currentFiles[$fileInfo->filePath] = $fileInfo;
        return $this;
    }

    public function diff(){
        $diff = new DiffFileList();
        $this->sort();

        $currentFiles   = $this->currentFiles;
        $previousFiles  = $this->previousFiles;

        if(empty($previousFiles)){
            $this->previousFiles = $currentFiles;
            return $diff;
        }

        //exit;
        foreach($previousFiles as $path=>$info){
            if(!isset($currentFiles[$path])){
                $diff->addDeletedFile($info);
                continue;
            }
            if(DiffFileList::isChanged( $info, $currentFiles[$path])){
                $diff->addChangedFile($currentFiles[$path]);
            }
            unset($currentFiles[$path]);
        }

        foreach($currentFiles as $fileInfo){
            $diff->addNewFile($fileInfo);
        }

        //var_dump($this);
        return $diff;
    }

    private function sort(){
        $currentFiles = &$this->currentFiles;
        ksort($currentFiles);
        /*, function( FileInfo $fa, FileInfo $fb ){
            $a = $fa->filePath;
            $b = $fb->filePath;
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });
        */
        return $this;
    }

}