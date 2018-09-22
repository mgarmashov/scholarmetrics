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
                            <a href="{{route('password.reset', ['token' => $token])}}" target="_blank">Reset Password</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
</table>
@endsection

