<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getUnreadNotifications()
    {
        return Auth::guard('admin')->user()->unreadNotifications;
    }

    public function index(Request $request)
    {
        return view('backend.pages.notifications');
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()->unreadNotifications->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return ['status' => 'success', 'message' => 'Notification marked as read.'];
        } else {
            return [
                'status' => 'warning', 'messsage' => 'Something went wrong!',
            ];
        }
    }

    public function markAsUnread(Request $request, $id)
    {
        $notification = $request->user()->notifications->where('id', $id)->first();
        if ($notification) {
            $notification->markAsUnread();
            return $this->sendResponseData($request, $notification->type);
        } else {
            return sendFailedResponse($request);
        }
    }

    public function delete(Request $request, $id)
    {
        $notification = $request->user()->notifications->where('id', $id)->first();
        if ($notification) {
            $type = $notification->type;
            $notification->delete();
            return $this->sendResponseData($request, $type);
        } else {
            return sendFailedResponse($request);
        }
    }

    public function markAllAsRead(Request $request)
    {
        $unreadNotifications = $request->user()->unreadNotifications;
        if ($unreadNotifications) {
            $unreadNotifications->markAsRead();
            return ['status' => 'success', 'message' => 'All notifications marked as read.'];
        } else {
            return [
                'status' => 'warning', 'messsage' => 'No unread notifications!',
            ];
        }
        return $this->sendResponseData($request);
    }

    public function deleteAll(Request $request)
    {
        $notifications = $request->user()->notifications;
        foreach ($notifications as $notification) {
            $itemDeleted = $notification->delete();
        }

        return $this->sendResponseData($request);
    }

    public function sendResponseData($request, $type = NULL)
    {
        if ($request->ajax()) {
            return [
                'count' => $this->guard()->user()->unreadNotifications()->count(),
                'readtime' => Carbon::now()->format('d M y, H:i:s'),
                'rest' => $type ? $this->guard()->user()->unreadNotifications()->whereType($type)->count() : NULL,
            ];
        }

        return back();

    }

    public function sendFailedResponse($request)
    {
        if ($request->ajax()) {
            return [
                'warning' => 'Something went wrong!',
            ];
        }
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
