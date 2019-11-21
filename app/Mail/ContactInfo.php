<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactInfo extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $contacts, $job, $msg, $catelog;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input = [])
    {

        $this->name = $input['Name'];
        $this->contacts = $input['Email'];
        $this->job = $input['Career'];
        $this->msg = nl2br($input['Content']);
        $this->catelog = isset($input['catelog']) ? $input['catelog'] : '官網';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('single.mail_contact')->subject('康碁官網 客戶來信');
    }
}
