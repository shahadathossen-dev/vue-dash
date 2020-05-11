<?php

namespace App\Models;

use App\Models\Backend\Message\Replies;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['name', 'email', 'phone', 'message', 'replied_at', 'replied'];

    public function replies()
    {
        return $this->hasMany(Replies::class);
    }
}
