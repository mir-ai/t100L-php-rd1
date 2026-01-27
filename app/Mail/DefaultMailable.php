<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use App\Services\Helpers\Helper;

/**
 * メール配信テンプレート（デフォルト）	
 */
class DefaultMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $fromEmail;
    protected $fromName;
    protected $viewName;
    protected $compactedData;
    protected $mailSubject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $fromEmail, string $fromName, string $viewName, $compactedData, string $subject)
    {
        //
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
        $this->viewName = $viewName;
        $this->compactedData = $compactedData;
        $this->mailSubject = $subject;

        assert($fromEmail);
        assert($viewName);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // おまじない
        //$this->view($this->viewName, $this->compactedData);
        $this->text($this->viewName, $this->compactedData);

        return $this
        ->subject($this->mailSubject)
        ->from(
            $this->fromEmail,
            $this->fromName,
        );
    }
}
