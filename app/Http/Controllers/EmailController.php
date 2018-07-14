<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactsMail;

class EmailController extends Controller
{
    //
    public function sendContactEmail(Request $request)
    {

//        dd($request->all());
        $data = [
            'subject' => $request->input('subject'),
            'author_email' => $request->input('author_email'),
            'name' => $request->input('name'),
            'message' => $request->input('message')
        ];

        Mail::send(new ContactsMail($data));

        return response()->json(['message' => 'Thanks for contacting us!', 'sendstatus' => 1]);
    }
}
