<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return [
            'notifications' => auth()->user()->notifications
        ];
    }

    public function readIt(Request $request)
    {
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }
}
