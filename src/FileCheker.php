<?php
namespace Dda2543\FileChecker;

use Dda2543\FileChecker\Entityes\DiffFileList;
use Dda2543\FileChecker\Entityes\FileInfo;
use Dda2543\FileChecker\Entityes\FileLists;
use Dda2543\FileChecker\Entityes\IncludeExtensionList;
use Dda2543\FileChecker\Events\ChangesFound;
use Dda2543\FileChecker\Events\ChangesNotFound;
use Dda2543\FileChecker\Interfases\ReadOnlyInterfase;
use Dda2543\FileChecker\Traits\DispatcherTrait;
use Dda2543\FileChecker\Traits\ReadOnlyTrait;

/**
 * Сканер директории на предмет изменения файлов
 * 
 * 
 */
class FileChecker implements ReadOnlyInterfase{
    use ReadOnlyTrait;
	use DispatcherTrait;
	/**
	 * папка, которую контролируем (включая подпапки)
	 *
	 * @var string
	 */
	private $rootdir = "../";

	/**
	 * включить в сканирование файлы со следующими расширениями. Если массив пустой, то ищем сканируем всё
	 *
	 * @var IncludeExtensionList
	 */
	public $includeExtensions;

	
	/**
	 * Обработчик списков файлов 
	 *
	 * @var FileLists
	 */
	private $fileList;
	

	/**
	 * Измененные файлы
	 *
	 * @var DiffFileList
	 */
	public $diffFiles;

	/**
	 * Флаг работы/остановки
	 *
	 * @var boolean
	 */
	private $runFlag = false;

	private $dispatched = [];


	public function __construct(string $rootdir = './', array $includeExtensions = ['*'])
	{
		$this->rootdir 				= $rootdir;
		$this->fileList				= new FileLists();
		$this->includeExtensions 	= new IncludeExtensionList();
		$this->includeExtensions->set($includeExtensions);
	}


    public function getReadOnlyProperties():array{
        return [
            'rootdir',
            'fileList',
			'runFlag',
        ];
    }
	/**
	 * функция сбора информации о файлах в директории
	 *
	 * @param string $cat Проверяемая директория
	 *
	 * @return void
	 */
	private function checkDir(string $cat) {
		$extensions = $this->includeExtensions->toArray();
		$dir = dir($cat);
		while($file = $dir->read()) {
			if ($file=='.' or $file=='..') continue;
			if (is_dir($cat.$file)) {
				$this->checkDir($cat.$file.'/');
			}
			//включаем в сканирование только файлы с расширениями из массива
			if ((count($extensions)==0)||!in_array(pathinfo($file, PATHINFO_EXTENSION),$extensions)) { continue; }
			
			$fileInfo = new FileInfo($cat.$file);
			$this->fileList->add($fileInfo);
		}
	}

	/**
	 * Найти разницу между состояниями файлов
	 *
	 * @return \Dda2543\FileChecker\Entityes\DiffFileList
	 */
	private function diff():DiffFileList
	{
		$diff = $this->fileList->diff();

		return $diff;
	}

	
	public function checkChanges():DiffFileList{
		$this->fileList->resertCurrentFiles();
		$this->checkDir($this->rootdir);
		$diff = $this->diff();
		if($diff->isEmpty()) $this->dispatch(new ChangesNotFound());
		else $this->dispatch(new ChangesFound($diff));
		return $diff;
	}

	public function run(){
		$this->runFlag = true;
		$this->loop();
	}

	public function stop(){
		$this->runFlag = false;
	}

	private function loop(){
		while($this->runFlag){
			$this->checkChanges();
		}
	}
}
