<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Blog;
use Validator;
use Mail;

class BlogController extends Controller {

    /**
     * Function to return user blog page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin/blog/blogList');
    }

    /**
     * Function to fetch the blog listing
     * @param void
     * @return array
     */
    public function fetchBlog(Request $request) {
        $start = $request->input('iDisplayStart');      // Offset
        $length = $request->input('iDisplayLength');     // Limit
        $sSearch = $request->input('sSearch');            // Search string
        $col = $request->input('iSortCol_0');         // Column number for sorting
        $sortType = $request->input('sSortDir_0');         // Sort type
        // Datatable column number to table column name mapping
        $arr = ['id', 'title'];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $blog = Blog::where('title', 'like', '%' . $sSearch . '%')
                ->orWhere('title', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Blog::where('title', 'like', '%' . $sSearch . '%')->orWhere('title', 'like', '%' . $sSearch . '%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($blog) > 0) {
            foreach ($blog as $blg) {
                $blogImage = !empty($blg->blog_image) ? asset('storage/uploads/blog').'/'.$blg->blog_image : asset('storage/images') . '/not-available.jpg';
                $action = '<a href="addBlog/' . $blg->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteBlog/' . $blg->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this blog?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = [$k+1, "<img src='$blogImage' height='50' width='50'>", $blg->title,$blg->url,$blg->description,$blg->rating,$blg->status, $action];
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save blog details
     * @param void
     * @return array
     */
    public function saveBlog(Request $request, $cId = null) {
        if ($request->isMethod('get')) {
            $BlogDetails = "";
            $button = 'Add';
            if (!empty($cId)) {
                $button = 'Update';
                $BlogDetails = Blog::where(['id' => $cId])->first();
            }

            return view('admin.blog.addBlog', ['BlogDetails' => $BlogDetails, 'button' => $button]);
        }
        /* ADD/EDIT COMPANY */
        if ($request->isMethod('post')) {

            $postData = $request->all();
//            prd($postData);
            $cId = ($request->input('savebtn') == 'Update') ? $cId : '';
            $BlogDetails = ($request->input('savebtn') == 'Add') ? new Blog() : Blog::where(['id' => $cId])->first();

            $BlogDetails->title = !empty($postData['title']) ? $postData['title'] : $BlogDetails->title;
            $BlogDetails->url = !empty($postData['url']) ? $postData['url'] : $BlogDetails->url;
            $BlogDetails->description = !empty($postData['description']) ? $postData['description'] : $BlogDetails->description;
            $BlogDetails->rating = !empty($postData['rating']) ? $postData['rating'] : $BlogDetails->rating;
            $BlogDetails->status = !empty($postData['status']) ? $postData['status'] : $BlogDetails->status;

            $blogLogo = $request->file('blog_image');
            if (!empty($blogLogo)) {
                $logoFileName = upload_admin_images($blogLogo, 'blog');
                if (!empty($logoFileName)) {
                    $BlogDetails->blog_image = $logoFileName;
                }
            }

            if (($request->input('savebtn') == 'Add')) {
                $BlogDetails->created_at = date('Y-m-d H:i:s');
                $BlogDetails->save();
                set_flash_message('Blog Added Successfully.', 'alert-success');
            } else {
                $BlogDetails->updated_at = date('Y-m-d H:i:s');
                $BlogDetails->update();
                set_flash_message('Blog Updated successfully', 'alert-success');
            }
            return redirect('admin/blogs');
        }
    }

    /**
     * Function to fetch the selected Blog details
     * @param void
     * @return array
     */
    public function getBlogDetails(Request $request) {
        $blogId = $request->input('blogId');
        $blogDetails = Blog::find($blogId);
        return response()->json($blogDetails);
    }

    /**
     * Function to delete Blog
     * @param void
     * @return array
     */
    public function deleteBlog(Request $request, $blogId) {
        $blog = Blog::find($blogId);
        if ($blog->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'blog deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('admin/blogs');
    }

}
