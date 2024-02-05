<?php

namespace App\Listeners;

use App\Services\OTPSend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMobileVerificationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //


        $user = $event->user;
        $otpService = new OTPSend();
        $otpService->sendOTP(str_replace('+', '', $user->dial_code), $user->mobile);


    }
}
