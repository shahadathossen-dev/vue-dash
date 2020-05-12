<?php

namespace App\Models\Backend\System;

use App\Models\Backend\User;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

}
