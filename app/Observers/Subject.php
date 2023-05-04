<?php
namespace App\Observers;

class Subject
{
    private $observers;
    private $state;

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;

        $this->notify();
    }

    public function attach(AbstractObserver $observer)
    {
        $this->observers[spl_object_hash($observer)] = $observer;
    }

    public function detach(AbstractObserver $observer)
    {
        $id = spl_object_hash($observer);

        unset($this->observers[$id]);
    }

    public function notify()
    {
        foreach($this->observers as $id => $observer) {
            $observer->update();
        }
    }
}