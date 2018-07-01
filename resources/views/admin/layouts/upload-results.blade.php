<div class="nav-tabs-custom" id="FileUploadData">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#{{ urlencode('Cites') }}" data-toggle="tab">Cites</a></li>
        <li><a href="#{{ urlencode('Current Schools') }}" data-toggle="tab">Current Schools</a></li>
    </ul>
    <div class="tab-content">
        @foreach($data as $sheetname => $rows)
        <div class="tab-pane" id="{{ urlencode($sheetname) }}">
            <div class="box-body">
                <table id="{{ urlencode($sheetname) }}Table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        @foreach($rows[0] as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    {{ count($rows) }}
                    @for($i=1; $i<count($rows); $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            @foreach($rows[$i] as $column)
                                <td>{{ $column }}</td>
                            @endforeach
                        </tr>
                    @endfor
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        @foreach($rows[0] as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endforeach

    </div>
    <!-- /.tab-content -->
</div>

<script>
    $(function () {
        @foreach($data as $sheetname => $rows)
        $('#{{ urlencode($sheetname) }}Table').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
        @endforeach
    })
</script>