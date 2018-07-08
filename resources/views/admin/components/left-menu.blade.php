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
            <li {{ setActive('admin.uploadExcelPage') }}><a href="{{ route('admin.uploadExcelPage') }}"><i class="fa fa-file-excel-o"></i> <span>Upload new file</span></a></li>
            <li {{ setActive('admin.data') }} class="treeview">
                <a href="{{ route('admin.data') }}">
                    <i class="fa fa-table"></i>
                    <span>Watch metrics data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.data') }}/cites"><i class="fa fa-graduation-cap"></i> Cites</a></li>
                    <li><a href="{{ route('admin.data') }}/schools"><i class="fa fa-university"></i> Current Schools</a></li>
                </ul>
            </li>
            <li {{ setActive('admin.statistics') }}><a href="{{ route('admin.statistics') }}"><i class="fa fa-bar-chart"></i> <span>Statistics of views</span></a></li>
            <li {{ setActive('admin.content') }}><a href="{{ route('admin.content') }}"><i class="fa fa-pencil"></i> <span>Change content</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>