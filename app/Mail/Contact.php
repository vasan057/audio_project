<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Dexel\Contact\Models\ContactModel;
class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $type;
    public function __construct(ContactModel $user,$type)
    {
        $this->user = $user;
        $this->type = $type;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->type  == 'admin'){
            $subject = 'Contact form entry '.$this->user->fname.' '.$this->user->lname;
            return $this->view('mail.coach.contact')->subject($subject);
        }
        if($this->type=='user'){
            $subject = 'Your message has been received';    
            return $this->view('mail.user.contact')->subject($subject);
        }              
    }
}