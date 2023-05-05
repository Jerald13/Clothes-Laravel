<?php

namespace App\Observers;

use App\Observers\AbstractObserver;
use App\Notifications\MyNotification;

class UpdateStatusObserver extends AbstractObserver
{
    public function update()
    {
        // sms
        $user = auth()->user();
        $user->notify(new MyNotification());
    }
}