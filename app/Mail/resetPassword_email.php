<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class resetPassword_email extends Mailable
{
    

    /**
     * Create a new message instance.
     */
    use Queueable, SerializesModels;
    private $data=[];
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data= $data;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Hoteru@gmail.com', 'Hoteru')
        ->subject($this->data["subject"])
                    ->view('resetPassword_email')->with("data",$this->data);
    }
}
