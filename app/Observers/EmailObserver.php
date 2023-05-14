<?php
namespace App\Observers;

use App\Observers\AbstractObserver;
use Illuminate\Support\Facades\Mail;
use App\Notifications\VerifyEmail;



class EmailObserver extends AbstractObserver
{
    public function update()
    {
        // send email message to the user when the payment has been made
        $user = auth()->user();
        $subjectState = $this->subject->getState();
        Mail::to($user->email)->send(new VerifyEmail($subjectState));
    }
}