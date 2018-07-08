@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="content" id="content">
        <section class="metrics" id="metrics"></section>
        <h2 class="pageHeader">Metrics</h2>
        <ul class="tabs">
            <li class="active" tab-link="#personTab">Search Person</li>
            <li tab-link="#departmentTab">Search Department</li>
            <li tab-link="#reportsTab">Custom Reports</li>
            <div class="clearfix"></div>
        </ul>
        <div class="search-area-container">
            @section('personTab')
            <div class="search-area search-area--person" id="personTab">
                <div class="search-area__leftSide">
                    <div class="search-area__step1">
                        <h3 class="search-area__stepHeader"><span class="search-area__stepHeader-number">1</span>Input name of scholar</h3>
                        <form class="search-area__searchLine">
                            <input class="textfield" type="text" placeholder="Last Name" id="last_name">
                            <!--input(type='submit', value='Search').submitBtn--><a class="searchBtn" href="#" id="searchPersonBtn"><img src="img/icon_search.png"></a><span class="search-area__note">*3 letters at least</span><img class="search-area__loading" src="img/loading_spinner.gif">
                        </form>
                    </div>
                    <h3 class="search-area__stepHeader no-results">No matches found</h3>
                    <div class="search-area__step2">
                        <h3 class="search-area__stepHeader"><span class="search-area__stepHeader-number">2</span>Choose from the following:</h3>
                        <ul class="search-area__filterList"></ul>
                    </div>
                </div>
                <div class="search-area__rightSide"></div>
                <div class="clearfix"></div>
            </div>
            @show
            <div class="search-area search-area--department" id="departmentTab">
                <div class="search-area__leftSide">
                    <div class="search-area__step1">
                        <h3 class="search-area__stepHeader"><span class="search-area__stepHeader-number">1</span>Input name of school</h3>
                        <form class="search-area__searchLine">
                            <input class="textfield" type="text" placeholder="Name" id="last_name">
                            <!--input(type='submit', value='Search').submitBtn--><a class="searchBtn" href="#" id="searchDepartmentBtn"><img src="{{ asset('img/icon_search.png') }}"></a><span class="search-area__note">*3 letters at least</span><img class="search-area__loading" src="{{ asset('img/loading_spinner.gif') }}">
                        </form>
                    </div>
                    <h3 class="search-area__stepHeader no-results">No matches found</h3>
                    <div class="search-area__step2">
                        <h3 class="search-area__stepHeader"><span class="search-area__stepHeader-number">2</span>Choose from the following:</h3>
                        <ul class="search-area__filterList"></ul>
                    </div>
                </div>
                <div class="search-area__rightSide"></div>
                <div class="clearfix"></div>
            </div>
            <div class="search-area search-area--reports" id="reportsTab">
                <p class="usualParagraph">Please let us know if you would like a custom tabulation of the data, either for individuals or departments. Describe the variables you would like to see as well as particular characteristics you are interested in. We will contact you with questions and let you know if there is a cost involved.
                <form class="contactForm" id="contactForm_report">
                    <input type="text" placeholder="Name" id="c_name">
                    <input type="email" placeholder="E-mail" id="c_email">
                    <!--input(type='text' placeholder='Subject')#c_subject-->
                    <textarea name="message" placeholder="Report description" id="c_message"></textarea>
                    <input id="sendMessage" type="submit" value="send">
                </form>
                <div class="ajax-response"></div>
                </p>
                <div class="clearfix"></div>
            </div>
            <!--#loadingTab.search-area.metrics__loading-->
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{ asset('js/metrics.js') }}"></script>
    <script src="{{ asset('assets/Chart.min.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
@endpush
    {{--getPersonList--}}

