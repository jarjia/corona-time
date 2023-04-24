<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
    */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.mail.verify-notice',
        );
    }

    public function build()
    {
        return $this->view('auth.mail.verify-notice')->with([
            'verifyUrl' => $this->verificationUrl(),
        ])->attach(public_path('/images/email-verify.png'), [
            'as' => 'email-verify.png',
            'mime' => 'email-verify/png',
        ]);
    }

    public function verificationUrl()
    {
        return URL::temporarySignedRoute(
            'signup.verify',
            Carbon::now()->addMinutes(30),
            ['user' => auth()->user()->id]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
