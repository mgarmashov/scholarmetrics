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
                            <ul>
                                @foreach(config('excelColumns') as $sheet=>$rows)
                                <li>{{ $sheet }}
                                    <ul class="manyColumns">
                                        @foreach($rows as $column)
                                            <li>{{ $column }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
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
                    $('#fileDataBlock').remove();
                    $('#resultsBlock').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>')

                },
                success: function(data)
                {
                    $("#resultsBlock").replaceWith(data);
                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    </script>
@endpush