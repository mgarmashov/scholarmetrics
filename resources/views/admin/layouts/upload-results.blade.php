<div class="box box-primary" id="resultsBlock">
    <div class="box-header with-border">
        <h3 class="box-title">Results</h3>
    </div>
    <div class="results-list">

    </div>
</div>
<div class="nav-tabs-custom" id="fileDataBlock">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#resultsTab1" data-toggle="tab">Cites</a></li>
        <li><a href="#resultsTab2" data-toggle="tab">Current Schools</a></li>
    </ul>
    <div class="tab-content">
        @php $n=1; @endphp
        @foreach($data as $sheetname => $rows)
            @php
                echo $n==1 ? "<div class='tab-pane active' id='resultsTab{$n}'>" : "<div class='tab-pane' id='resultsTab{$n}'>";
                $n++;
            @endphp

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