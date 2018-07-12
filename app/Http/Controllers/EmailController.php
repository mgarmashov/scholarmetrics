<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function send(Request $request)
    {

//        dd($request->all());
        $title = $request->subject;
        $email = $request->email;
        $name = $request->name;
        $text = $request->message;

        Mail::send('email.contacts', ['title' => $title, 'content' => $text], function ($message) use ($name)
        {

            $message->from('contacts@scholarmetrics.com', $name);

            $message->to('mikhail.garmashov@gmail.com');

        });

        return response()->json(['message' => 'Request completed']);
    }
}
