<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AcademyYear;

class NotificationSessionController extends Controller
{
    public function index(){
        $notifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\SessionSend');
        return view('admin.notifications.session.index');
    }

    public function getReadNotifications(Request $request) {
        $perPage = $request->perPage;
        $active_year = AcademyYear::whereActive(true)->first();

        if($request->filter === "1"){
            if($perPage === "all") {
                $notifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\SessionSend')->where('academy_year_id', $active_year->id);

            } else {
                $notifications = auth()->user()->unreadNotifications()->where('type', 'App\Notifications\SessionSend')->where('academy_year_id', $active_year->id)->paginate($perPage);
            }

        } else {
            if($perPage === "all") {
                $notifications = auth()->user()->readNotifications->where('type', 'App\Notifications\SessionSend')->where('academy_year_id', $active_year->id);
            } else {
                $notifications = auth()->user()->readNotifications()->where('type', 'App\Notifications\SessionSend')->where('academy_year_id', $active_year->id)->paginate($perPage);
            }
        }


        return response()->json([
            'notifications' => $notifications,
            'filter' => $request->filter,
        ]);
    }

    public function markAsRead(Request $request)
    {
        $active_year = AcademyYear::whereActive(true)->first();

        if($request->id === "mark-all") {
            auth()->user()->unreadNotifications->where('type', 'App\Notifications\SessionSend')->where('academy_year_id',$active_year->id )->markAsRead();
        } else {
            auth()->user()->unreadNotifications->where('id', $request->id)->markAsRead();
        }

        return response()->json([
            'marked' => $request->id,
        ]);
    }
}
