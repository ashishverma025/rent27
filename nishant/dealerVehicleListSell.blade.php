@include('dashboard/includes.admin-head')
@include('dashboard/includes.admin-sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
    @endif
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </section>
    <?php // pr($_POST); ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <!-- /.card-header -->
                <div class="card-header " style="background-color: #337ab7; color: white">
                     Vehicle Listing
                </div>
                <div class="card-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a href="{{url('addDealerVehicle')}}" id="update_attendance_table" class=" btn btn-primary"> Add New</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--EXIST STUDENTS LIST-->
                    <span id="csv_err" class="errMsg"></span>
                    <div class="alert alert-danger" id="res_err" style="display: none"> <strong>Warning!</strong></div>

                    <input type="hidden" id="user_type" value="{{@$type}}" />
                    <form action="{{url('updateattendence')}}" class="tuti-form profile-form" id="update_attendance" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div>
                            <div>
                                <table class="table  table-striped table-bordered table-hover dataTable no-footer" data-page-length='10' id="editable_table" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th class="wid-20" tabindex="0" rowspan="1" colspan="1">Sl</th>
                                            <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Dealer Name</th>
                                            <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Vehicle</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Distance Covered</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Truck Image</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Truck Name</th>
                                            <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Source Address</th>
                                            <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Destination Address</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th>
                                            <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@include('dashboard/includes.admin-footer')


<script>
//Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()
    $("#classList, #dateFilter").change(function () {
        $("#filterForm").submit()
    });

    $(document).on('click', '#update_attendance_table', function () {
        $("#update_attendance").submit();
    });

    $(document).ready(function () {
        var base_url = "{{url('/')}}";
        var url = base_url + '/fetchvehicles'
        //alert(base_url + '/admin/fetchUsers');

        var table = $('#editable_table');

        table.DataTable({
            dom: "<'text-right'B><f>lr<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
            buttons: [
                'copy', 'csv', 'print'
            ],
            "sServerMethod": "get",
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": url,
            "columnDefs": [
                {"className": "dt-center", "targets": [0, 2, 2]}
            ],
            "aoColumns": [
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': true},
                {'bSortable': false, "width": "10%"}
            ]
        });
        var tableWrapper = $("#editable_table_wrapper");
        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown
        $("#editable_table_wrapper .dt-buttons .btn").addClass('btn-secondary').removeClass('btn-default');
        $(".dataTables_wrapper").removeClass("form-inline");
    });
</script>
