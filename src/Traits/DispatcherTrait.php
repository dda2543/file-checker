<?php
namespace Dda2543\FileChecker\Traits;

use Dda2543\FileChecker\Events\Event;
use Exception;
use LogicException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

trait DispatcherTrait{

    private $dispatcher;

    /**
     * Устанавливает диспетчер событий.
     *
     * Диспетчер не может быть изменен после завершения инициализации, так как некоторые подключения и плагины
     * уже добавили слушателей. Изменение его приведет к поломке.
     *
     * @param EventDispatcherInterface|null $dispatcher
     *
     * @return $this
     */
    public function setEventDispatcher(?EventDispatcherInterface $dispatcher): self
    {
        if ($this->initialized) {
            throw new LogicException("Event Dispatcher can not be changed once the Daemon is initialized");
        }
        $this->dispatcher = $dispatcher;
        return $this;
    }

    /**
     * Вернуть текущий диспетчер событий. Если ни один из них не определен, сначала создается новый объект.
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->dispatcher ?? $this->dispatcher = new EventDispatcher();
    }

    /**
     * Отправка события в шину событий.
     *
     * @param string           $eventName
     * @param Event|null $event
     *
     * @return Event|DaemonEvent
     */
    public function dispatch(Event $event = null)
    {
        $eventName = $event::getName();
        $event->setFileChecker($this);
        
        if (!isset($this->dispatched[$eventName])) {
            $this->dispatched[$eventName] = 1;
        } else {
            $this->dispatched[$eventName]++;
        }
        return $this->getEventDispatcher()->dispatch($event, $eventName);
    }

    /**
     * Добавить прослушиватель в диспетчер событий.
     *
     * @param string   $event     Событие, которое стоит прослушать.
     * @param callable $callback  Callback.
     * @param int      $priority  Чем выше это значение, тем раньше в цепочке вызывается прослушиватель.
     *
     * @return $this
     */
    public function on(string $event, callable $callback, int $priority = 0): self
    {
        if(!is_a($event, Event::class, true)) throw new Exception("События должны наследоваться от ". Event::class);
        $eventName = $event::getName();
        if (!is_callable($callback)) {
            throw self::createInvalidArgumentException(func_get_args(), 'Invalid callable argument #2');
        }

        $this->getEventDispatcher()->addListener($eventName, $callback, $priority);
        return $this;
    }

    /**
     * Удалить обработчик событий в диспетчере.
     *
     * @param string   $event Название события, из которого требуется удалить.
     * @param callable $callback  Обратный вызов должен соответствовать ранее установленному вызываемому объекту.
     *
     * @return $this
     */
    public function off(string $event, callable $callback): self
    {
        if(!is_a($event, Event::class, true)) throw new Exception("События должны наследоваться от ". Event::class);
        $eventName = $event::getName();
        $this->getEventDispatcher()->removeListener($eventName, $callback);
        return $this;
    }
}