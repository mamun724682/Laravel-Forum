<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function notifications()
    {
    	auth()->user()->unreadNotifications->markAsRead();
    	// dd(auth()->user()->notifications()->first()->data['discussion']['slug']);

    	return view('users.notifications', [
    		'notifications' => auth()->user()->notifications
    	]);
    }
}
