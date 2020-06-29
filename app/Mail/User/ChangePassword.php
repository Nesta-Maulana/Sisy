<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$hostname,$password)
    {
        $this->user             = $user;
        $this->hostname         = $hostname;
        $this->password         = $password;
    }

    public function build()
    {
        $user       = $this->user;
        $hostname   = $this->hostname;
        $password   = $this->password;
        return $this->view('auth.mail.change-password',['userData'=>$user,'hostname'=>$hostname,'password'=>$password])->subject('Sisy | Change Password');
    }
}
