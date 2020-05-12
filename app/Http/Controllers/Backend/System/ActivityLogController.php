<?php

namespace App\Http\Controllers\Backend\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Backend\System\ActivityLog;

class ActivityLogController extends Controller
{

    public function panel()
    {
        return view('backend.system.access-log-panel');
    }

    public function accessLogs(Request $request)
    {
        return view('backend.system.access_log');
    }

    /**
     * Display a datatable of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTable()
    {
        $activityLogs = ActivityLog::select(['id', 'admin_id', 'user_ip', 'action', 'status', 'created_at']);

        return DataTables::of($activityLogs)
            ->addColumn('view', function ($query) {
                return '<button data-id="' . $query->id . '" class="btn btn-sm btn-primary view"><i class="fa fa-binoculars"></i> View</button>';
            })
            ->addColumn('subject', function ($query) {
                return $query->user->username;
            })
            ->rawColumns(['subject', 'view'])
            ->make(true);
    }

    public function show(Request $request)
    {
        return ActivityLog::findOrFail($request->log)->with(['user' => function($query){
            $query->select('id', 'username');
        }])->first();
    }
}
