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
    <?php
    $dob = get_custom_dob();
    $userDetails = (!empty($userData)) ? $userData : getUserDetails();
//    prd($userDetails);
    
    $name = isset($userDetails->name) ? explode(' ', $userDetails->name) : '';
    $fname = isset($name[0]) ? $name[0] : '';
    $lname = isset($name[1]) ? $name[1] : '';
    $UserDob = isset($userDetails->dob) ? currentUser_dob($userDetails->dob) : '';
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid add-student">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> Profile Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('profile')}}" id="t_profile" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="student_id" value="<?= @$TutorStudent->id ?>" >
                            <input type="hidden" name="user_id" value="<?= @$id ?>" >

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img src="{{ asset('storage/uploads/sites/users') }}<?= !empty($userDetails->avatar) ? '/' . $userDetails->id . '/' . $userDetails->avatar : '/dummy.jpg' ?>" id="userImg" height="80" width="80">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mgt30">
                                            <!-- bnew -->
                                            <div class="file btn btn-primary">
                                                Upload
                                                <input type="file" class="custom-file-input hide-this" name="user_image" id="user_image" onchange= "readURL(this, 'userImg')" >
                                            </div>
                                            <!-- bnew -->
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label> First Name</label>
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" value="<?= @$fname ?>" required>
                                    @if ($errors->has('fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label> Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ ($userDetails->email != '') ? $userDetails->email : ''}}">
                                    <span id="email-err" style="color: red"></span> 
                                    @if (@$errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ @$errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <!-- <div class="form-group">
                                    <label> Gender</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option>Select</option>
                                        <option <?= ($userDetails->gender == 'Male') ? 'selected' : '' ?>>Male</option>
                                        <option <?= ($userDetails->gender == 'Female') ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div> -->


                                @if(@$userDetails->role_id == 1)
                                <div class="form-group">
                                    <label> Company Registration Number</label>
                                    <input type="text" class="form-control" id="company_registration_number" name="company_registration_number" value="<?= @$userDetails->company_registration_number ?>" placeholder="Company Registration Number" disabled>
                                    @if (@$errors->has('company_registration_number'))
                                    <span class="help-block">
                                        <strong>{{ @$errors->first('company_registration_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @endif

                                {{--<div class="form-group">
                                    <label> WebSite Url </label>
                                    <input type="text" id="website_url" name="website_url" class="form-control" placeholder="Website Url" value="{{@$userData->website_url}}">
                                </div>--}}
                                <div class="form-group">  <label>&nbsp;</label>
                                    <div class="row"><div class="col-md-4">
                                            <button type="submit" id="edit_profile" class="btn btn-primary">Save</button></div></div>
                                </div>
                            </div>
                            <div class="col-md-6 mgt10">
                                <div class="form-group">
                                    <label> Last Name</label>
                                    <input type="text" id="lname" name="lname" class="form-control" value="<?= @$lname ?>" required>
                                    @if (@$errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ @$errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label> Mobile Number</label>
                                    <input id="phone" type="text" class="form-control" value="<?= @$userDetails->mobile_no ?>" name="phone" placeholder="Contact ">

                                </div>

                                <div class="form-group">
                                    <label> Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= @$userDetails->address ?>" placeholder="Address">
                                    @if (@$errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ @$errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>


                            @if(@$userDetails->role_id == 1)
                                <div class="form-group">
                                    <label> Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?= @$userDetails->company_name ?>" placeholder="Company Name" disabled>
                                    @if (@$errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ @$errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Number Of Trucks</label>
                                    <input type="text" class="form-control" id="truck_number" name="truck_number" value="<?= @$userDetails->truck_number ?>" placeholder="Number Of Truck">
                                    @if (@$errors->has('truck_number'))
                                    <span class="help-block">
                                        <strong>{{ @$errors->first('truck_number') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            @endif
                                <!--<div class="form-group">
                                    <label> Dob</label>
                                    <div class="row">
                                        <div class="col-sm-4">          

                                            <select class="form-control" name="months" id="months">

                                                @foreach($dob['months'] as $key => $value) {
                                                <option value="<?= $key ?>" <?= (@$UserDob['months'] == $key) ? 'selected' : '' ?>><?= $value ?></option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">          
                                            <select class="form-control" name="days" id="days">
                                                <?php
                                                foreach ($dob['days'] as $key => $value) {
                                                    ?>
                                                    <option value="<?= $value ?>" <?= (@$UserDob['days'] == ($key + 1)) ? 'selected' : '' ?>><?= $value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">   
                                            <select class="form-control" name="years" id="years">
                                                <?php
                                                foreach ($dob['years'] as $key => $value) {
                                                    ?>
                                                    <option value="<?= $value ?>" <?= (@$UserDob['years'] == $value) ? 'selected' : '' ?>><?= $value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </form>
                    <!-- /.col -->
                </div>

            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('public/sites/users/js/common.js') }}"></script>

<script>

//$('#email').on('blur', function () {
//    var email = $('#email').val();
//    $.ajax({
//        url: $('meta[name="route"]').attr('content') + '/isemailexist',
//        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//        method: 'post',
//        data: {'email': email},
//        success: function (res) {
//            if (res.status == 'exist') {
//                $('#email-err').text(res.msg)
//                $("#save-resume").attr('type', 'button');
//            } else {
//                $('#email-err').text('')
//                $("#save-resume").attr('type', 'submit');
//            }
//            console.log(res.status)
//        }
//    })
//});
</script>

<script>
    function readURL(input, divID) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('#' + divID).show()
            reader.onload = function (e) {
                $('#' + divID).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@include('dashboard/includes.admin-footer')
