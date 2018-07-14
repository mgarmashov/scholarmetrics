@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="content" id="content">
        <section class="contact" id="contact">
            <h2 class="pageHeader">Contact</h2>
            <p class="usualParagraph text-center">Please let us know if you have any questions or comments.</p>
            <form class="contactForm" id="contactForm1" method="post" action="{{ route('sendContactEmail') }}">
                <input type="text" placeholder="Name" name='name' id="c_name">
                <input type="email" placeholder="E-mail" name='author_email' id="c_email">
                <input type="text" placeholder="Subject" name='subject' id="c_subject">
                <textarea name="message" placeholder="Message" id="c_message"></textarea>
                @csrf
                <button id="sendMessage" type="submit">Send</button>
            </form>
            <div class="ajax-response"></div>
        </section>
    </div>
@endsection

@push('scripts')

    <script>
        $("#contactForm1").submit(function(e) {
            // var url = sendEmailUrl+"/contact";

            e.preventDefault();

            var c_name,c_email,c_subject,c_message ='';

            c_name = $("#c_name").val();
            c_email = $("#c_email").val();
            c_subject = $("#c_subject").val();
            c_message = $("#c_message").val();
            responseMessage = $('.ajax-response');

            if (( c_name== "" || c_email == "" || c_message == "") || (!isValidEmailAddress(c_email) )) {
                responseMessage.fadeIn(500);
                responseMessage.html('<i class="fa fa-warning"></i> Check all fields.');
            }

            else {
                // console.log = 'sdf';
                // var formData = new FormData($(this)[0]);
                // console.log = formData;
                $.ajax({
                    type: "POST",
                    url: "{{ route('sendContactEmail') }}",
                    dataType: 'json',
                    data: $(this).serialize(),
                    // data: {
                    //     c_email: c_email,
                    //     c_name: c_name,
                    //     c_subject: c_subject,
                    //     c_message: c_message
                    // },
                    beforeSend: function() {
                        $('#contact-form1 button').empty();
                        $('#contact-form1 button').append('<i class="fa fa-cog fa-spin"></i> Wait...');
                        responseMessage.html('Thanks for contacting us!');
                        responseMessage.fadeIn(1000);
                    },
                    success: function(result) {
                        console.log(result);
                        // if(result.sendstatus == 1) {
                        //     responseMessage.html(result.message);
                        //     responseMessage.fadeIn(500);
                        //     $('#contactForm, #contactForm_report').fadeOut(500);
                        // } else {
                        //     $('#contact-form button').empty();
                        //     $('#contact-form button').append('<i class="fa fa-retweet"></i> Try again.');
                        //     responseMessage.html(result.message);
                        //     responseMessage.fadeIn(1000);
                        // }
                    }
                });
            }

        });

    </script>
@endpush
