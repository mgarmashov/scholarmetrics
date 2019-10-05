@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="content" id="content">
        <section class="contact" id="contact">
            <h2 class="pageHeader">Contact</h2>
            <p class="usualParagraph text-center">Please let us know if you have any questions or comments.</p>
            @include('components.contactForm', ['messageType'=>'sendContactEmail'])
        </section>
    </div>
@endsection
