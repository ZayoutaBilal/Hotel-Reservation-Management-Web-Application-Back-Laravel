<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class myEmail extends Mailable
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
        ->subject($this->data['subject'])
                    ->view('email_page')->with("data",$this->data);
    }
}