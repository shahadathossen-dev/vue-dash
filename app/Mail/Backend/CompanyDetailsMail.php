<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Backend\System\Company;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompanyDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $media;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
        $this->media = (object) array('logo' => $this->company->logo);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('backend.emails.company-test-mail')
                    ->from(config('mail.from.address'), strtoupper(str_replace('-', ' ', config('mail.from.name'))))
                    ->subject('Test Mail');
    }
}
