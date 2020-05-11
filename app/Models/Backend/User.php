<?php

namespace App\Models\Backend;

use Spatie\Permission\Models\Role;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\Backend\AdminResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable, HasRoles, HasMediaTrait;

    protected $table = 'admins';
    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')->singleFile()
            ->useFallbackUrl(asset('storage/backend/default/user.png'))
            ->useFallbackPath(asset('storage/backend/default/user.png'))
            ->registerMediaConversions(function(Media $media){
                $this->addMediaConversion('icon')->width(50)->keepOriginalImageFormat();
            });
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Backend\User\Status', 'status_id', 'id');
    }

    public function statusIs($status)
    {
        return $this->status()->whereName($status)->exists();
    }

    public function roleIs($role)
    {
        return $this->role($role)->exists();
    }

    public function getRoleAttribute()
    {
        return $this->getRoleNames()->first();
    }

    public function getIconAttribute()
    {
        return $this->getFirstMedia('avatar')->getUrl('icon');
    }

    public function getNameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }

}
