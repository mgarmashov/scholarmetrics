@extends('admin.layouts.app')

@push('styles')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('title', 'Edit Content')

@section('content')

    <div class="row">
        <div class="col-md-12">
                <form method="post" action="{{ route('admin.post-content') }}">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Content for &laquo;About&raquo;</h3>
                            <small><a href="{{ route('about') }}">{{ route('about') }}</a></small>
                        </div>
                        <div class="box-body pad">
                            <textarea class="textarea" placeholder="Place some text here" name="about"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{ \App\Models\Content::about() }}
                            </textarea>
                        </div>
                    </div>

                    <div class="box box-default">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="year" class="col-sm-2 control-label">Year</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="year" name="year" placeholder="2017" value="{{ \App\Models\Content::year() }}">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <img class="img-responsive" src="{{ asset('assets/adminLTE/img/year-example.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @csrf
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                    </div>
                    <!-- /.box-footer -->
                    </div>
            </form>
        </div>
    </div>
    <!-- /.row -->
@endsection

@push('scripts')
    <script src="{{ asset('assets/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script>
        $('.textarea').wysihtml5();
    </script>

@endpush