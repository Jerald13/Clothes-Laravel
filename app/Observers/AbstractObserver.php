<?php
namespace App\Observers;

abstract class AbstractObserver
{
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;

        $this->subject->attach($this);
    }

    abstract public function update();
}