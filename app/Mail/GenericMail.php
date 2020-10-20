<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subjectInfo;
    protected $title;
    protected $description;
    protected $button_url;
    protected $button_text;


    public function __construct($notification)
    {
        $this->subjectInfo = $notification->subject;
        $this->title = $notification->title;
        $this->description = $notification->description;
        $this->button_url = $notification->button_url;
        $this->button_text = $notification->button_text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            "title" => $this->title,
            "description" => $this->description,
            "button_url" => $this->button_url,
            "button_text" => $this->button_text,
        ];
        return $this->subject($this->subjectInfo)->view('mails.generic-mail', $data);
    }
}
