<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class CancelRequest extends Mailable
{
    use Queueable, SerializesModels;


    protected $task;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task=$task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('scholarscarpak@gmail.com')
                    ->subject('CPS link')
                    ->markdown('mail.canceltask')->with(['task' => $this->task]);
    }
}
