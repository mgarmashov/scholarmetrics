@extends('admin.layouts.app')

@section('title', 'Statistics')

@section('content')
    <style>
        .byLink{
            color: green;

        }
        .personIsOpened{
            color: darkred;
        }
        .personIsSearched td{
            background: rgba(182,0,34,0.1) !important;
            color: rgba(182,0,34,1);

        }
        .deptIsOpened{
            color: darkblue;
        }
        .deptIsSearched{
            background: rgba(0,0,139,0.1) !important;
            color: rgba(0,0,139,1);
        }

    </style>

    <div class="row">
        <div class="col-md-12">

            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-bullhorn"></i>

                    <h3 class="box-title">Top 5 watched for last 90 days</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-4">
                        <p><b>Opened persons</b></p>
                        <ul>
                            @foreach($tops['#personTab'] as $row)
                                <li>{{ $row['name'] }}: {{ $row['total'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p><b>Opened schools</b></p>
                        <ul>
                            @foreach($tops['#departmentTab'] as $row)
                                <li>{{ $row['name'] }}: {{ $row['total'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p><b>Opened persons bu shortlink</b></p>
                        <ul>

                            @foreach($tops['byLink'] as $row)
                                {{--{{dd($row)}}--}}

                                <li>{{ $row['name'] }}: {{ $row['total'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistics</h3>
                </div>
                <div class="box-body">
                    Rows: {{ $count }}
                    <div class="results-list">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Name/Text</th>
                                <th>Type</th>
                                <th>IP Address (country)</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $row)
                                @php

                                @endphp
                                <tr class="{{ $row->tdClass }}">


                                    <td>{!! $row->id !!}</td>
                                    <td>{!! $row->updated_at !!}</td>
                                    <td>{!! $row->name !!}</td>
                                    <td>{!! $row->type !!}</td>
                                    <td>{!! $row->ip_address !!}</td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Name/Text</th>
                                <th>Type</th>
                                <th>IP Address (country)</th>
                            </tr>
                            </tfoot>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@push('scripts')
    {{--<script>--}}
        {{--// $(document).ready(function() {--}}
            {{--@foreach($data as $sheetname => $rows)--}}
            {{--$('#historyTable').DataTable({--}}
                {{--responsive: {--}}
                    {{--details: {--}}
                        {{--type: 'column',--}}
                        {{--target: 'tr'--}}
                    {{--}--}}
                {{--},--}}
                {{--columnDefs: [ {--}}
                    {{--className: 'control',--}}
                    {{--orderable: false,--}}
                    {{--targets:   0--}}
                {{--} ],--}}
                {{--order: [ 1, 'asc' ]--}}
            {{--});--}}
            {{--@endforeach--}}
        {{--})--}}
    {{--</script>--}}

@endpush