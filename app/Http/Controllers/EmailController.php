<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactsMail;

class EmailController extends Controller
{

    public function sendContactEmail(Request $request)
    {

        $data = [
            'subject' => $request->input('subject'),
            'author_email' => $request->input('author_email'),
            'name' => $request->input('name'),
            'message' => $request->input('message')
        ];

        Mail::send(new ContactsMail($data, 'contacts'));

        return response()->json(['message' => 'Successful! Thanks for contacting us!', 'sendstatus' => 1]);
    }


    public function sendReportEmail(Request $request)
    {

        $data = [
            'author_email' => $request->input('author_email'),
            'name' => $request->input('name'),
            'message' => $request->input('message')
        ];

        Mail::send(new ContactsMail($data, 'report'));

        return response()->json(['message' => 'Successful! Thanks for contacting us!', 'sendstatus' => 1]);
    }
}
