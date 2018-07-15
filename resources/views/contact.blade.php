@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="content" id="content">
        <section class="contact" id="contact">
            <h2 class="pageHeader">Contact</h2>
            <p class="usualParagraph text-center">Please let us know if you have any questions or comments.</p>
            <form class="contactForm" id="contactForm" method="post" action="{{ route('sendContactEmail') }}">
                <input type="text" placeholder="Name" name='name' id="c_name">
                <input type="email" placeholder="E-mail" name='author_email' id="c_email">
                <input type="text" placeholder="Subject" name='subject' id="c_subject">
                <textarea name="message" placeholder="Message" id="c_message"></textarea>
                @csrf
                <button id="sendMessageBtn" type="submit">Send</button>
            </form>
            <div class="ajax-response"></div>
        </section>
    </div>
@endsection

@push('scripts')

    <script>
        $("#contactForm").submit(function(e) {

            e.preventDefault();

            var c_name = $("#c_name").val();
            var c_email = $("#c_email").val();
            var c_subject = $("#c_subject").val();
            var c_message = $("#c_message").val();
            var responseMessage = $('.ajax-response');

            if (( c_name== "" || c_email == "" || c_message == "") || (!isValidEmailAddress(c_email) )) {
                responseMessage.fadeIn(500);
                responseMessage.html('<i class="fa fa-warning"></i> Check all fields.');
            }

            else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('sendContactEmail') }}",
                    dataType: 'json',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $("#sendMessageBtn").html('<i class="fa fa-cog fa-spin"></i> Wait...');
                    },
                    success: function(result) {
                        if(result.sendstatus == 1) {
                            responseMessage.html(result.message);
                            responseMessage.fadeIn(500);
                            $('#contactForm').fadeOut(500);
                        } else {
                            // $('#contact-form button').empty();
                            $("#sendMessageBtn").html('<i class="fa fa-retweet"></i> Try again.');
                            responseMessage.html(result.message);
                            responseMessage.fadeIn(1000);
                        }
                    }
                });
            }

        });

    </script>
@endpush
