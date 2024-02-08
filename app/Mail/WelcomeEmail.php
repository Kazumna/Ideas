<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     */

     //This is header of the email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thanks for joining ' . config('app.name', ''),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //this wil be blade file
        //In order to pass data to blade file, use "With"
        return new Content(
            view: 'emails.welcome-email',
            with: [
                'user' => $this->user,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('public', 'profile/U5LP9gRaSyBg8ZmT8hMaKft43MV3IHukmJYJ8kjw.jpg'),
        ];
    }
}
