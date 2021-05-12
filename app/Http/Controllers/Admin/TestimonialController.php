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
use App\Testimonial;
use Validator;
use Mail;

class TestimonialController extends Controller {

    /**
     * Function to return user testimonial page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin/testimonial/testimonialList');
    }

    /**
     * Function to fetch the testimonial listing
     * @param void
     * @return array
     */
    public function fetchTestimonial(Request $request) {
        $start = $request->input('iDisplayStart');      // Offset
        $length = $request->input('iDisplayLength');     // Limit
        $sSearch = $request->input('sSearch');            // Search string
        $col = $request->input('iSortCol_0');         // Column number for sorting
        $sortType = $request->input('sSortDir_0');         // Sort type
        // Datatable column number to table column name mapping
        $arr = ['id', 'name'];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $testimonial = Testimonial::where('name', 'like', '%' . $sSearch . '%')
                ->orWhere('name', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Testimonial::where('name', 'like', '%' . $sSearch . '%')->orWhere('name', 'like', '%' . $sSearch . '%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($testimonial) > 0) {
            foreach ($testimonial as $truk) {
                $testimonialImage = !empty($truk->image) ? asset('storage/uploads/testimonial').'/'.$truk->image : asset('storage/images') . '/not-available.jpg';
                $action = '<a href="addTestimonial/' . $truk->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteTestimonial/' . $truk->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this testimonial?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = [$k+1, "<img src='$testimonialImage' height='50' width='50'>", $truk->name,$truk->description,$truk->status, $action];
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save testimonial details
     * @param void
     * @return array
     */
    public function saveTestimonial(Request $request, $cId = null) {
        if ($request->isMethod('get')) {
            $TestimonialDetails = "";
            $button = 'Add';
            if (!empty($cId)) {
                $button = 'Update';
                $TestimonialDetails = Testimonial::where(['id' => $cId])->first();
            }

            return view('admin.testimonial.addTestimonial', ['TestimonialDetails' => $TestimonialDetails, 'button' => $button]);
        }
        /* ADD/EDIT COMPANY */
        if ($request->isMethod('post')) {

            $postData = $request->all();
//            prd($postData);
            $cId = ($request->input('savebtn') == 'Update') ? $cId : '';
            $TestimonialDetails = ($request->input('savebtn') == 'Add') ? new Testimonial() : Testimonial::where(['id' => $cId])->first();

            $TestimonialDetails->name = !empty($postData['name']) ? $postData['name'] : $TestimonialDetails->name;
            $TestimonialDetails->description = !empty($postData['description']) ? $postData['description'] : $TestimonialDetails->description;
            $TestimonialDetails->status = !empty($postData['status']) ? $postData['status'] : $TestimonialDetails->status;

            $testimonialLogo = $request->file('image');
            if (!empty($testimonialLogo)) {
                $logoFileName = upload_admin_images($testimonialLogo, 'testimonial');
                if (!empty($logoFileName)) {
                    $TestimonialDetails->image = $logoFileName;
                }
            }

            if (($request->input('savebtn') == 'Add')) {
                $TestimonialDetails->created_at = date('Y-m-d H:i:s');
                $TestimonialDetails->save();
                set_flash_message('Testimonial Added Successfully.', 'alert-success');
            } else {
                $TestimonialDetails->updated_at = date('Y-m-d H:i:s');
                $TestimonialDetails->update();
                set_flash_message('Testimonial Updated successfully', 'alert-success');
            }
            return redirect('admin/testimonials');
        }
    }

    /**
     * Function to fetch the selected Testimonial details
     * @param void
     * @return array
     */
    public function getTestimonialDetails(Request $request) {
        $testimonialId = $request->input('testimonialId');
        $testimonialDetails = Testimonial::find($testimonialId);
        return response()->json($testimonialDetails);
    }

    /**
     * Function to delete Testimonial
     * @param void
     * @return array
     */
    public function deleteTestimonial(Request $request, $testimonialId) {
        $testimonial = Testimonial::find($testimonialId);
        if ($testimonial->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'testimonial deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('admin/testimonials');
    }

}
