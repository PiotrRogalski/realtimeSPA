<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Illuminate\Notifications\DatabaseNotificationCollection;

class NotificationController extends Controller
{
    public function index() {
        if (auth()->user()) {
            return ['notifications' => auth()->user()->notifications];
        }
    }

    public function readIt(Request $id) {
        if (auth()->user()) {
            auth()->user()->notifications->where('id', $id)->markAsRead();
        }
    }
}
