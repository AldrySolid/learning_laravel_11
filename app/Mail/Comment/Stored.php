<?php

namespace App\Mail\Comment;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Stored extends Mailable
{
    use Queueable, SerializesModels;

    protected Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('mail.from.address'),
                'Admin'
            ),
            subject: 'Comment Stored',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.comment.stored',
            with: [
                'comment' => $this->comment
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
