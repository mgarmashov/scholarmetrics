@extends('metrics')
@php($person = $data['persons'][0])

@section('personTab')
<div class="search-area search-area--person" id="personTab">
    <div class="search-area__leftSide">
        <div class="search-area__step1">
            <h3 class="search-area__stepHeader"><span class="search-area__stepHeader-number">1</span>Input name of
                scholar</h3>
            <form class="search-area__searchLine">
                <input class="textfield" type="text" placeholder="Last Name" id="last_name" value = "{{ $person['lastName'] }}">
                    <a class="searchBtn" href="#" id="searchPersonBtn">
                        <img src="{{ asset('img/icon_search.png') }}">
                    </a>
                <span class="search-area__note">*3 letters at least</span>
                <img class="search-area__loading" src="{{ asset('img/loading_spinner.gif') }}">
            </form>
        </div>
        <h3 class="search-area__stepHeader no-results">No matches found</h3>
        <div class="search-area__step2">
            <h3 class="search-area__stepHeader"><span class="search-area__stepHeader-number">2</span>Choose from the
                following:</h3>
            <ul class="search-area__filterList"></ul>
        </div>
    </div>
    <div class="search-area__rightSide">

        <div class="search-area__step3 search-area__results" data-person-block="{{ $person['id'] }}" style="display: block;">
            <div class="search-area__socialButtons">
                @if(!empty($person['website']))
                    <a title="Web-site" target="_blank" href="{{ $person['website'] }}">
                        <i class="fa fa-globe"></i>
                    </a>
                @endif
                @if(!empty($person['twitter']))
                    <a title="Twitter" target="_blank" href="{{ $person['twitter'] }}">
                        <i class="fa fa-twitter"></i>
                    </a>
                @endif
                @if(!empty($person['linkedIn']))
                    <a title="LinkedIn" target="_blank" href="{{ $person['linkedIn'] }}">
                        <i class="fa fa-linkedin"></i>
                    </a>
                @endif

            </div>
            <h3 class="search-area__results-title">{{ $person['lastName'].', '.$person['firstName'] }}</h3>
            <span class="search-area__results-shortlink">{{ route('metrics') .'/'. $person['shortlink'] }}</span>

            <a href="https://twitter.com/intent/tweet?original_referer={{route('metrics')}}&amp;ref_src=twsrc%5Etfw&amp;related=ScholarMetrics&amp;text=Check%20out%20my%20ScholarMetrics%20profile%20at&amp;tw_p=tweetbutton&amp;url={{ route('metrics') .'/'. $person['shortlink'] }}&amp;via=ScholarMetrics"
                    target="_blank" class="twitter-share-button"
                    data-url="{{ route('metrics') .'/'. $person['shortlink'] }}"
                    data-text="Check out my ScholarMetrics profile at" data-size="large"><img
                        src="{{ asset('img/twitter-share.png') }}" alt="Tweet"></a>
            <div class="search-area__results-text"><p><b>Position/rank: </b>{{ $person['position'] }}</p>

                <p><b>University: </b>{{ $person['university'] }}</p>
                <p><b>University rank: </b>{{ \App\Models\Schools::schoolRank($person['university']) }}</p>
                <p><b>Degree School: </b>{{ $person['degreeSchool'] }} ({{ $person['year'] }})</p>
                <p><b>Academic interests: </b>{{ $person['academicInterests'] }}</p>
                <p><b>Google Scholar: </b><a title="Google Scholar" target="_blank"
                                             href="{{ $person['googleScholar'] }}">Open
                        profile <i class="fa fa-external-link"></i></a></p>
                <p><b>ResearchGate: </b><a title="ResearchGate" target="_blank"
                                           href="{{ $person['researchGate'] }}">Open profile <i
                                class="fa fa-external-link"></i></a></p>
                <hr>
                <div class="tooltip__container whatIsIt">
                    <div data-tooltip-id="g-{{ $person['id'] }}" class="tooltip__link">What does it mean<i
                                class="fa fa-question-circle-o"></i></div>
                    <div id="g-{{ $person['id'] }}" style="visibility: hidden; display: none;" class="tooltip__item whatIsIt__popup">
                        <p>"Citation" count is derived from Google Scholar (GS). The number indicates current estimate
                            of how many times this scholar’s is cited in other publications indexed by GS.</p>
                        <p>100% represents the highest quantity of citations by a scholar within the discipline. The
                            percentile rank indicates the percentage of scholars with fewer GS citations.</p>
                        <p>The graphs show the total number of citations on the Y-axis and percentile rank on the
                            X-axis. The percentile shown is in comparison with all faculty as well as faculty in same
                            position - Assistant, Associate, or (Full) Professor.</p></div>
                </div>
                <h3 class="h3--rating">Citation ranking</h3>
                <p><b>Citations:&nbsp;</b>{{ $person['total'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>H-Index:&nbsp;</b>{{ $person['h_index'] }}</p>
                <p><b>Citation percentile ranking compared to all faculty:&nbsp;</b></p>

                @if(!empty($person['citationsFaculty']))
                    <div class="diagram__container">
                        <canvas id="chartAll-{{ $person['id'] }}"></canvas>
                        <img src="{{ asset('/img/loading_spinner.gif') }}" class="diagram__loading">
                    </div>
                @else
                    'N/A'
                @endif

                <p><b>Citation percentile ranking compared to other faculty in same position ({{ $person['position'] }}):&nbsp;</b></p>
                @if(!empty($person['citationsRank']))
                    <div class="diagram__container">
                        <canvas id="chartPosition-{{ $person['id'] }}"></canvas>
                        <img src="{{ asset('/img/loading_spinner.gif') }}" class="diagram__loading">
                    </div>
                @else
                    'N/A'
                @endif


            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection

@push('scripts')
    <script>
        $( document ).ready(function() {
            diagramAjax(
                    "{{ $person['id'] }}",
                    "{{ $person['firstName'] }}",
                    "{{ $person['lastName'] }}",
                    "{{ $person['total'] }}",
                    "{{ $person['citationsFaculty'] }}",
                    "{{ $person['position'] }}",
                    "{{ $person['citationsRank'] }}",
                    {{  json_encode($data['chartStat'   ]['all_positions']) }},
                    {{  json_encode($data['chartStat'][$person['position']]) }}
            );
            saveHistory('byLink');
        });

    </script>
@endpush