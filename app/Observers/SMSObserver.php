<?php

namespace App\Observers;

use App\Observers\AbstractObserver;
use App\Notifications\MyNotification;

class SMSObserver extends AbstractObserver
{
    public function update()
    {
        // send sms message to the user when the payment has been made
        $user = auth()->user();
        $subjectState = $this->subject->getState();
        $user->notify(new MyNotification($subjectState));
    }
}