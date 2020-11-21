<?php

namespace App\Mail\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class bienvenidaDirect extends Mailable
{
    use Queueable, SerializesModels;
     
    public $dato;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
         $dato=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170157@uttcampus.edu.mx')
        ->view('emails.Bienvenida');
    }
}
