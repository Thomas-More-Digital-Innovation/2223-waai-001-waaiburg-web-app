<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notifiable;
use App\Models\InfoContent;

class CreateAccountWebApp extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $infoContent;
    public $actionText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->infoContent = InfoContent::where("info_id", 3)
            ->get()
            ->first(); //info_id: 3 = account create webapp mail in database
        $this->actionText = "Inloggen"; //Text on button in mail
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(subject: $this->infoContent->title);
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(markdown: "vendor.notifications.email");
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
