<?php

namespace App\Models\Backend\System;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Company extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'company_settings';
    protected $guarded = [];


    public function registerMediaCollections()
    {
        $this->addMediaCollection('logo')->singleFile()
            ->useFallbackUrl(asset('storage/default/logo.png'))
            ->useFallbackPath(asset('storage/default/logo.png'));

        $this->addMediaCollection('icon')->singleFile()
            ->useFallbackUrl(asset('storage/default/favicon.png'))
            ->useFallbackPath(asset('storage/default/favicon.png'));
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function hasInvoices()
    {
        return $this->invoices()->exists();
    }
}
