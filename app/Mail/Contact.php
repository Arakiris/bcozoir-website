<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The contact instance.
     *
     * @var Contact
     */
    public $subject;
    public $civility;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $messages;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($information)
    {
        $this->subject = $information['subject'];
        $this->civility = $information['civility'];
        $this->first_name = $information['first_name'];
        $this->last_name = $information['last_name'];
        $this->email = $information['email'];
        $this->phone = $information['tel'];
        $this->messages = $information['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.contact');
    }
}
