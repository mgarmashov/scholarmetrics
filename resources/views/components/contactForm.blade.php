<form class="contactForm" id="contactForm" method="post" action="{{ route($messageType) }}">
    <input type="text" placeholder="Name" name='name' id="c_name">
    <input type="email" placeholder="E-mail" name='author_email' id="c_email">
  @if($messageType == 'sendContactEmail')
    <input type="text" placeholder="Subject" name='subject' id="c_subject">
  @endif
    <textarea name="message" placeholder="Message" id="c_message"></textarea>
    {!! \Biscolab\ReCaptcha\Facades\ReCaptcha::htmlFormSnippet() !!}
    @csrf
    <button id="sendMessageBtn" type="submit">Send</button>
</form>
<div class="ajax-response"></div>


@push('scripts')
    {!! htmlScriptTagJsApi() !!}
    <script>
      $("#contactForm").submit(function(e) {

        e.preventDefault();

        var c_name = $("#c_name").val();
        var c_email = $("#c_email").val();
        @if($messageType == 'sendContactEmail')
          var c_subject = $("#c_subject").val();
        @endif
        var c_message = $("#c_message").val();
        var responseMessage = $('.ajax-response');

        if (( c_name== "" || c_email == "" || c_message == "") || (!isValidEmailAddress(c_email) )) {
          responseMessage.fadeIn(500);
          responseMessage.html('<i class="fa fa-warning"></i> Check all fields.');
        }

        else {
          $.ajax({
            type: "POST",
            url: "{{ route($messageType) }}",
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
                $("#sendMessageBtn").html('<i class="fa fa-retweet"></i> Try again.');
                responseMessage.html(result.message);
                responseMessage.fadeIn(1000);
              }
            },
            error: function(result) {
              responseMessage.fadeIn(500);
              responseMessage.html('<i class="fa fa-warning"></i> '+result.responseJSON.message);
              grecaptcha.reset();
              $("#sendMessageBtn").html('Send');
            }
          });
        }
      });

    </script>
@endpush