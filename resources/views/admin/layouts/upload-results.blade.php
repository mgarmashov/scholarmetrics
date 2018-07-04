<div class="box box-primary" id="resultsBlock">
    <div class="box-header with-border">
        <h3 class="box-title">Results</h3>
    </div>
    <div class="box-body">
        <div class="results-list">

        </div>
    </div>

</div>

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
                    <th></th>
                    <th>#</th>
                    @foreach($rows[0] as $column => $value)

                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                {{ count($rows) }}
                @for($i=1; $i<count($rows); $i++)
                    <tr>
                        <td></td>
                        <td>{{ $i }}</td>
                        @foreach($rows[$i] as $column)
                            <td>{{ $column }}</td>
                        @endforeach
                    </tr>
                @endfor
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th>#</th>
                    @foreach($rows[0] as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function() {
        @foreach($data as $sheetname => $rows)
        $('#{{ studly_case($sheetname) }}Table').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ]
        });
        @endforeach
    })
</script>