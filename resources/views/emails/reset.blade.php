@extends('emails.template')

@section('preheader')
    You ordered password reset
@endsection


@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <p>For changing password, use a bottom link</p>
                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                    <tbody>
                    <tr>
                        <td align="left">
                            {{--<table border="0" cellpadding="0" cellspacing="0">--}}
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td>--}}
                                        <a href="{{route('password.reset', ['token' => $token])}}" target="_blank">Reset Password</a>
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        </td>
                    </tr>
                    </tbody>
                </table>
                {{--<p>This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>--}}
                {{--<p>Good luck! Hope it works.</p>--}}
            </td>
        </tr>
</table>
@endsection

