<?php

namespace App\Modules\Comment\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicCommentNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $web_site_url)
    {
        $this->content = $content;
        $this->web_site_url = $web_site_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('您的动态有新的评论/回复【' . getenv('APP_NAME') . '】')
            ->markdown('comment::mails.dynamic.comment', ['url' => $this->web_site_url, 'content' => $this->content]);
    }
}
