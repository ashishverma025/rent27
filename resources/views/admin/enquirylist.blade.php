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
                    Enquiry Listing
                </div>
                <div class="card-body">
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
                    <form action="{{url('updateattendence')}}" class="tuti-form profile-form" id="update_attendance" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div>
                            <div>
                                <table class="table  table-striped table-bordered table-hover dataTable no-footer" data-page-length='10' id="editable_table" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th class="wid-20" tabindex="0" rowspan="1" colspan="1">Sl</th>
                                            <th class="sorting_asc wid-20" tabindex="0" rowspan="1" colspan="1">Name</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Email</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Mobile Number</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Message</th>
                                            <th class="sorting wid-10 bold" tabindex="0" rowspan="1" colspan="1">Pickup Location</th>
                                            <th class="sorting wid-10 bold" tabindex="0" rowspan="1" colspan="1">Pickup Date</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Drop Location</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Drop Date</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th>
                                            <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Enquiry Date</th>
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
    $(document).ready(function () {
        var base_url = "{{asset('/admin')}}";
        var url = base_url + '/fetchEnquiry'
        //alert(base_url + '/admin/fetchEnquirys');

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
                {"className": "dt-center", "targets": [0, 3, 2]}
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
