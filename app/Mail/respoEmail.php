<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class respoEmail extends Mailable
{
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
        ->subject("Admin Create Your Account As Receptionist in Hoteru")
                    ->view('Receptionist_email')->with("data",$this->data);
    }
}
