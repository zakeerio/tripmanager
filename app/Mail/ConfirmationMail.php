<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $activity_id = "500";
        $activity_date = "10-12-2022";
        $activity_time = "10:52";

        return  $this->subject('CCT Activity Confirmation - '.$activity_id.' - '.$activity_date.' at '.$activity_time)
        ->view('emails.confirmtionmail');
        // return $this->view('view.name');
    }
}
