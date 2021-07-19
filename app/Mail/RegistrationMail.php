<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * User to whom the mail has to be sent 
     * 
     * @var \App\User
     */
    protected $user;

    /**
     * Data for personalization 
     * 
     * @var array
     */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, array $data = [])
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject(config('message.message.welcome' . $this->user[User::SCHEMA_FIRST_NAME]))
                    ->with([
                        User::SCHEMA_FIRST_NAME => $this->user[User::SCHEMA_FIRST_NAME],
                    ])
                    ->view('emails.welcome');
    }
}
