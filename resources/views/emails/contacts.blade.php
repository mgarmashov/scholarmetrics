@extends('emails.template')

@section('preheader')
    Somebody sent you a message
@endsection


@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <p>Hi there,</p>
                <p>{{ $text }}</p>
                {{--<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                        {{--<td align="left">--}}
                            {{--<table border="0" cellpadding="0" cellspacing="0">--}}
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td> <a href="http://htmlemail.io" target="_blank">Call To Action</a> </td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}
                {{--<p>This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>--}}
                {{--<p>Good luck! Hope it works.</p>--}}
            </td>
        </tr>
        <tr>
            <td><b>Subject:</b> {{ $subject }}</td>
        <tr>
            <td><b>Email:</b> {{ $author_email }}</td>
        </tr>
        <tr>
            <td><b>Name:</b> {{ $name }}</td>
        </tr>
        <tr>
            <td><b>Message:</b> {{ $author_message }}</td>
        </tr>
</table>
@endsection

