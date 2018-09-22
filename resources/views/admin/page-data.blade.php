@extends('admin.layouts.app')

@push('styles')
@endpush

@section('title', 'Current Metrics Data')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @foreach($data as $sheetname => $rows)
                <div class="box box-primary dataBlock">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$sheetname}}</h3>
                    </div>
                    <div class="box-body">
                        <div class="results-list">
                            <table id="{{ studly_case($sheetname) }}Table" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    @if($sheetname == 'Cites')
                                        <th>shortlink</th>
                                    @endif
                                    @foreach(config('excelColumns')[$sheetname] as $column)
                                        <th>{{ $column['excelColumnName'] }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=1; $i<count($rows); $i++)
                                    <tr>
                                        <td>{{$i}}</td>
                                        @foreach($rows[$i] as $column)
                                            <td>{{ $column }}</td>
                                        @endforeach
                                    </tr>
                                @endfor
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    @foreach(config('excelColumns')[$sheetname] as $column)
                                        <th>{{ $column['excelColumnName'] }}</th>
                                    @endforeach
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- /.row -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
        // $(window).load(function () {
            @foreach($data as $sheetname => $rows)
            $('#{{ studly_case($sheetname) }}Table').DataTable({
                // responsive: {
                //     details: {
                //         type: 'column',
                //         target: 'tr'
                //     }
                // },
                "scrollX": true,
                // columnDefs: [ {
                //     className: 'control',
                //     orderable: false,
                //     targets:   0
                // } ],
                // order: [ 1, 'asc' ]
            });
            @endforeach
        })
    </script>
@endpush