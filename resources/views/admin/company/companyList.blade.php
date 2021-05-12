@include('admin/includes.admin-head')
@include('admin/includes.admin-sidebar')
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
                    Company Listing
                </div>
                <div class="card-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a href="{{url('admin/addCompany')}}" id="update_attendance_table" class=" btn btn-primary"> Add New</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--EXIST STUDENTS LIST-->
                    <span id="csv_err" class="errMsg"></span>
                    <div class="alert alert-danger" id="res_err" style="display: none"> <strong>Warning!</strong></div>
                    <div class="col-6" >
                        <form action="{{url('addLcGlobalStudent')}}" id="existEmail" enctype="multipart/form-data" method="post" accept-charset="utf-8" style="display:none">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <!--<label class="errMsg" id="res_err">These Students are already exist in global list</label>-->
                                    <select class="duallistbox" id="existStudents" name="students[]" multiple="multiple" style="display: none;">
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--<div class="table-toolbar">-->
                    <!--                    <div class="row">
                                            <div class="col-md-2">
                                                <div class="btn-group">
                                                    <a href="{{url('lcstudent')}}" id="update_attendance_table" class=" btn btn-primary"> Add Student</a>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <form enctype="multipart/form-data" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="">
                                                        <div class=" CSV-button-style">
                                                            <input type="file" name="csv_student" id="csv_student" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
                                                            <label for="csv_student"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> SELECT CSV</strong></label>
                                                            <button type="button" id="upload_students" class=" btn btn-default upld-csv">
                                                                <img src="{{url('ajax-loader.gif')}}" id="ajax-loaderimg" height="20" width="20" style="display: none">
                                                                Upload Student
                                                            </button>
                                                            <div class="btn-group users_grid_tools">
                                                                <a href="{{asset('students.csv')}}" download class=" btn btn-default" ><i class="fa fa-download" title="CSV Format"></i></a>
                                                                <div class="tools"></div>
                                                            </div>
                                                        </div>
                    
                                                    </div>
                                                <input type="file" name="csv_student" id="csv_student" class=" btn btn-default">
                                                </form>
                                            </div>
                                            <div class="col-md-4">
                    
                                                <div class="btn-group users_grid_tools">
                                                    <a href="{{url('lcstudent')}}?addManual=true" class=" btn btn-primary" style="margin-top:5px;">Add Students from Global List </a>         
                                                    <div class="tools"></div>
                                                </div>
                                            </div>
                                        </div>-->
                    <!--</div>-->
                    <input type="hidden" id="user_type" value="{{@$type}}" />
                    <form action="{{url('updateattendence')}}" class="tuti-form profile-form" id="update_attendance" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div>
                            <div>
                                <table class="table  table-striped table-bordered table-hover dataTable no-footer" data-page-length='10' id="editable_table" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th class="wid-20" tabindex="0" rowspan="1" colspan="1">Sl</th>
                                            <th class="sorting wid-25" tabindex="0" rowspan="1" colspan="1">Company Image</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Company Name</th>
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
@include('admin/includes.admin-footer')


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
        var base_url = "{{asset('/admin')}}";
        var user_type = $('#user_type').val();
        if (user_type == '') {
            var url = base_url + '/fetchCompany'
        } else {
            var url = base_url + '/fetchCompany/' + user_type
        }
        console.log(url);
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
