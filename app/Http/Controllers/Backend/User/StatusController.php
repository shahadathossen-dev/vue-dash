<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Models\Backend\User\Status;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function statuses()
    {
        return Status::all();
    }
}
