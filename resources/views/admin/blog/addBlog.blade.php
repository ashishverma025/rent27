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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid add-student">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{'Add '}} Blog </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('admin/addBlog')}}{{@$BlogDetails->id?'/'.@$BlogDetails->id:''}}" id="t_profile" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img src="<?= !empty(@$BlogDetails->blog_image) ? asset('storage/uploads/blog') . '/' . @$BlogDetails->blog_image : asset('storage/images') . '/not-available.jpg' ?>" id="userImg" height="80" width="80">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mgt30">
                                            <!-- bnew -->
                                            <div class="file btn btn-primary">
                                                Upload
                                                <input type="file" class="custom-file-input hide-this" name="blog_image" id="blog_image" onchange= "readURL(this, 'userImg')" >
                                            </div>
                                            <!-- bnew -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> Blog Title</label>
                                    <input type="text" id="fname" name="title" class="form-control" placeholder="Blog Title" value="<?= @$BlogDetails->title ?>" required>
                                    @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Blog Url</label>
                                    <input type="text" id="url" name="url" class="form-control" placeholder="Blog Url" value="<?= @$BlogDetails->url ?>" required>
                                    @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label> Blog Rating</label>
                                    <select name="rating" class="form-control">
                                        <option <?= @$BlogDetails->rating == 1 ? 'selected' : '' ?>>1</option>
                                        <option <?= @$BlogDetails->rating == 2 ? 'selected' : '' ?>>2</option>
                                        <option <?= @$BlogDetails->rating == 3 ? 'selected' : '' ?>>3</option>
                                        <option <?= @$BlogDetails->rating == 4 ? 'selected' : '' ?>>4</option>
                                        <option <?= @$BlogDetails->rating == 5 ? 'selected' : '' ?>>5</option>
                                    </select>
                                    @if ($errors->has('rating'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Description</label>
                                    <textarea  id="editor1" name="description" class="form-control textarea" placeholder="Description" required><?= @$BlogDetails->description ?></textarea>
                                    @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Status</label>
                                    <select name="status" class="form-control">
                                        <option <?= @$BlogDetails->status == 'Active' ? 'selected' : '' ?>>Active</option>
                                        <option <?= @$BlogDetails->status == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">  <label>&nbsp;</label>
                                    <div class="row"><div class="col-md-4">
                                            <button type="submit" id="edit_profile" name="savebtn" value="{{@$button}}" class="btn btn-primary">Save</button></div></div>
                                </div>
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
@include('admin/includes.admin-footer')
