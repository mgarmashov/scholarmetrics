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

