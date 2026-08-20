<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestQuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfContent;

    public function __construct($pdfContent)
    {
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->subject('طلب عرض سعر')
                    ->view('emails.thanks') // أي فيو بسيط يحتوي على "تم إرسال طلب عرض السعر"
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(translate("get_quote"))
                    ->attachData($this->pdfContent, 'quote.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
