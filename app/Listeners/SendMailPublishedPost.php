<?php

namespace App\Listeners;

use App\Events\PublishedPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\MailPublishedPost;

class SendMailPublishedPost implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PublishedPost  $event
     * @return void
     */
    public function handle(PublishedPost $event)
    {
        Mail::to($event->post->author->email)
        ->send(new MailPublishedPost());
    }
}
