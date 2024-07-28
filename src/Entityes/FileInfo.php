<?php

namespace Dda2543\FileChecker\Entityes;

use Exception;

/**
 * Информация о файле
 * 
 * @property-read string $filePath
 * 
 * 
 * @property-read int    $dev       Номер устройства (В Windows, начиная с PHP 7.4.0, это серийный номер тома, содержащего файл)
 * @property-read int    $ino       Номер inode
 * @property-read int    $mode      Режим защиты inode
 * @property-read int    $nlink     Количество ссылок
 * @property-read int    $uid       userid владельца (В Windows это всегда будет 0.)
 * @property-read int    $gid       groupid владельца (В Windows это всегда будет 0.)
 * @property-read int    $rdev      Тип устройства, если устройство inode
 * @property-read int    $size      Размер в байтах
 * @property-read int    $atime     Время последнего доступа (временная метка Unix)
 * @property-read int    $mtime     Время последней модификации (временная метка Unix)
 * @property-read int    $ctime     Время последнего изменения inode (временная метка Unix)
 * @property-read int    $blksize   Размер блока ввода-вывода файловой системы (Windows вернёт -1)
 * @property-read int    $blocks    Количество используемых 512-байтных блоков (Windows вернёт -1)
 */
class FileInfo{

    private $filePath;

    private $dev;
    private $ino;
    private $mode;
    private $nlink;

    private $uid;
    private $gid;
    private $rdev;
    private $size;
    private $atime;
    private $mtime;
    private $ctime;
    private $blksize;
    private $blocks;

    
    /**
     * Class constructor.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        
        $stat = stat($this->filePath);

        $this->dev      = $stat['dev'];
        $this->ino      = $stat['ino'];
        $this->mode     = $stat['mode'];
        $this->nlink    = $stat['nlink'];
        $this->uid      = $stat['uid'];
        $this->gid      = $stat['gid'];
        $this->rdev     = $stat['rdev'];
        $this->size     = $stat['size'];
        $this->atime    = $stat['atime'];
        $this->mtime    = $stat['mtime'];
        $this->ctime    = $stat['ctime'];
        $this->blksize  = $stat['blksize'];
        $this->blocks   = $stat['blocks'];
    }

    public function __get(string $name)
    {
        if(!property_exists($this, $name)) throw new Exception("Свойство '$name' не определено.");
        return $this->$name;
    }
}