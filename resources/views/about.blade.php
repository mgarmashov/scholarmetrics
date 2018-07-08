@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="content" id="content">
        <section class="about" id="about">
            <h2 class="pageHeader">About</h2>
            <div class="usualParagraph">
                {!!  \App\Models\Content::about() !!}
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $('.usualParagraph a').append('<i class="fa fa-external-link"></i>');
    </script>
@endpush

