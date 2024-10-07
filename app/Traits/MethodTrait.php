<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


trait MethodTrait
{

    // todo check login with username or email //
    protected function CheckField($request)
    {

        // ?login with phone number or email
        $field = filter_var($request->input('field'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = array(
            $field => $request->get('field'),
            'password' => $request->get('password')
        );
        return array(
            'credentials' => $credentials,
            'fields' => $field
        );

    }

    // todo check gmail and return code to do forget pass //
    protected function checkmail($email)
    {
        $id = User::where('email', $email)->value('id');
        //? Store a value in localStorage
        $user = User::find($id);
        if ($user) {
            $user->code = random_int(100000, 999999);
            return $user;
        }
        return null;
    }

    // todo check if user login or not use social account 
    protected function checkAuth($socialiteUser)
    {
        $user = User::where('email', $socialiteUser->email)->first();
        if ($user) {
            Auth::guard('web')->login($user);
            return redirect()->route('homeindex');
        } else {
            // ? sent request to method register create new user
            $request = new Request([
                'name' => $socialiteUser->name,
                'email' => $socialiteUser->email,
                'password' => null,
                'img' => $socialiteUser->avatar
            ]);
            return $request;
        }
    }


    // todo add new media 
    protected function Addmedia($info, $media)
    {
        $info->media()->create([
            'media' => $media
        ]);
    }
    //? use in factory
    protected function AddReport($info, $report, $comment)
    {
        $info->report()->create([
            'comment' => $comment,
            'report' => $report
        ]);
    }

    // todo add new media  for book
    protected function AddmediaBook($info, $mediaCover, $mediaFile)
    {
        $info->media()->create([
            'media' => $mediaCover,
            'pdf' => $mediaFile
        ]);
    }

    // todo add type of star for this book
    protected function getBooks($book)
    {
        $books = $book->map(function ($book) {
            $book->stars = $book->getTypeStars();
            return $book;
        });
        return $books;
    }


}