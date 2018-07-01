@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="content" id="content">
        <section class="contact" id="contact">
            <h2 class="pageHeader">Contact</h2>
            <p class="usualParagraph text-center">Please let us know if you have any questions or comments.</p>
            <form class="contactForm" id="contactForm">
                <input type="text" placeholder="Name" id="c_name">
                <input type="email" placeholder="E-mail" id="c_email">
                <input type="text" placeholder="Subject" id="c_subject">
                <textarea name="message" placeholder="Message" id="c_message"></textarea>
                <input id="sendMessage" type="submit" value="send">
            </form>
            <div class="ajax-response"></div>
        </section>
    </div>
@endsection

