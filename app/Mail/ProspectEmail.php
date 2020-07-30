<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProspectEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public $content;
    public $subject;
    public $attachment;

    public function __construct($content, $subject, $attachment = null)
    {
        $this->content = $content;
        $this->subject = $subject;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('prospect-email')
            ->subject($this->subject);
        if ($this->attachment) {
            foreach ($this->attachment as $key => $file) {
                $email->attachData(file_get_contents($file), $file->getClientOriginalName(), [
                    'mime' => $file->getMimeType()
                ]);
            }
        }
        return $email;
    }
}
