<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactsMail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{

    public function sendContactEmail(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'subject' => 'required',
            'author_email' => 'required',
            'message' => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);
        if($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()[0]], 422);
        }

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
        $validator = Validator::make(request()->all(), [
            'subject' => 'required',
            'author_email' => 'required',
            'message' => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);
        if($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->all()[0]], 422);
        }

        $data = [
            'author_email' => $request->input('author_email'),
            'name' => $request->input('name'),
            'message' => $request->input('message')
        ];

        Mail::send(new ContactsMail($data, 'report'));

        return response()->json(['message' => 'Successful! Thanks for contacting us!', 'sendstatus' => 1]);
    }
}
