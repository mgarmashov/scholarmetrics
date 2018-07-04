@extends('admin.layouts.app')

@section('title', 'Upload new file')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="box box-default box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">File format Requirements</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul>
                        <li>We need sheets:
                            @foreach (array_keys(config('excelColumns')) as $sheet)
                                <b>"{{ $sheet }}"</b>
                            @endforeach
                            </li>
                        <li>Names should be in 1st row</li>
                        <li>Data from 1st row isn't counted</li>
                        <li>Full list of columns
                    </ul>
                    @foreach (config('excelColumns') as $sheet => $rows)
                        <div class="callout bg-aqua-active">
                            <h4> {{ $sheet }}</h4>
                            <ul class="col-md-3">
                                @php $i=0 @endphp
                                @foreach($rows as $column)
                                    @if( $i!=0 && $i % 6 == 0)
                            </ul><ul class="col-sm-3">
                                @endif
                                <li>{{ $column['excelColumnName'] }}</li>
                                @php $i++ @endphp
                                @endforeach
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                    @endforeach

                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add file</h3>
                </div>
                <form id="fileUploadForm" action="{{ route('admin.uploadFile') }}" role="form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="attachedFile">File input</label>
                            <input type="file" id="attachedFile" name="attachedFile">
                            <p class="help-block">Upload XLS file.</p>
                        </div>
                        <div class="form-group">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box box-primary" id="resultsBlock">
                <div class="box-header with-border">
                    <h3 class="box-title">Results</h3>
                </div>
                <div class="results-list">

                </div>
            </div>
            <div class="nav-tabs-custom" id="fileDataBlock">

            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@push('footer-scripts')
{{--    <script src="{{ asset('assets/adminLTE/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js') }}"></script>--}}

    <script>
        $("#fileUploadForm").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                type: "POST",
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('#fileUploadForm input[name="_token"]').val()
                },
                url: '{{ route('admin.uploadFile') }}',
                data: formData,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('.dataBlock').remove();
                    $('#resultsBlock').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>')

                },
                success: function(data)
                {
                    $("#resultsBlock").replaceWith(data);
                },
                error: function(xhr)
                {
                    var res = xhr.responseJSON;
                    $("#resultsBlock").replaceWith('<div class="box box-primary" id="resultsBlock">' +
                        '<div class="box-header with-border">' +
                        '    <h3 class="box-title">Results</h3>' +
                        '</div>' +
                        '<div class="box-body">' +
                            '<div class="results-list">' + res.message + '</div>') +
                        '</div>';

                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    </script>
@endpush