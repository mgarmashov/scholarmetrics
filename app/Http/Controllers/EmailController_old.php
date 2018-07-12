<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Schools;
use Illuminate\Http\Request;
use App\Models\Cites;
use GuzzleHttp\Client;


class EmailController_old extends Controller
{

    public function init(Request $request)
    {
        // Contact
//        $to = 'tomwsanchez@gmail.com';
	$to = 'mikhail.garmashov@gmail.com';
        $subject_of_letter = 'ScholarRep. Contact Form from site';

        if(isset($request->c_name) && isset($request->c_email) && isset($request->c_subject)){
            $name    = $request->c_name;
            $email    = $request->c_email;
            $subject    = $request->c_subject;

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= $request['c_email'];


            $message = '<br />
					<h3>You recieved this message from contact-form on <a href="http://scholarmetrics.com/contact.html">http://scholarmetrics.com/contact.html</a> </h3><br />
					<b>Name:</b> '.$name.'<br />
					<b>Email:</b> '.$email.'<br />
					<b>Name:</b> '.$subject.'<br />
					<b>Message:</b><br />
					'.$request->c_message;

            if (mail($to, $subject_of_letter, $message, $headers)) {
                $result = array(
                    'message' => 'Thanks for contacting us!',
                    'sendstatus' => 1
                );
                return response()->json($result);
            } else {
                $result = array(
                    'message' => 'Sorry, something is wrong',
                    'sendstatus' => 1
                );
                return response()->json($result);
            }
        }



    }

}
