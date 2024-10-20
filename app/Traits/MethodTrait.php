<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;


trait MethodTrait
{

    // ?todo add new media 
    protected function Addmedia($info, $media)
    {
        $info->media()->create([
            'media' => $media
        ]);
    }


    // ?todo add new media 
    protected function AddListMedia($info, $images)
    {
        $media = json_encode($images);
        $info->media()->create([
            'list_media' => $media
        ]);
    }

    // ?todo create session
    protected function createSession($route)
    {
        Session::forget('route');
        Session::put('route', $route);
    }

    public function successNotification($type, $msg)
    {
        return Notification::send(auth()->user(), new Notifications($type, $msg));
    }
}