<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left info" style="position: initial">
                <p>{{ Auth::user()->name . ' ' . Auth::user()->surname }}</p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"> </li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ route('admin.uploadExcelPage') }}"><i class="fa fa-file-excel-o"></i> <span>Upload new file</span></a></li>
            <li><a href="#"><i class="fa fa-table"></i> <span>Watch metrics data</span></a></li>
            <li><a href="#"><i class="fa fa-bar-chart"></i> <span>Watching Statistics</span></a></li>
            <li><a href="#"><i class="fa fa-pencil"></i> <span>Change content</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>