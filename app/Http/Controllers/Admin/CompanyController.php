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
use App\Company;
use Validator;
use Mail;

class CompanyController extends Controller {

    /**
     * Function to return user company page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin/company/companyList');
    }

    /**
     * Function to fetch the company listing
     * @param void
     * @return array
     */
    public function fetchCompany(Request $request) {
        $start = $request->input('iDisplayStart');      // Offset
        $length = $request->input('iDisplayLength');     // Limit
        $sSearch = $request->input('sSearch');            // Search string
        $col = $request->input('iSortCol_0');         // Column number for sorting
        $sortType = $request->input('sSortDir_0');         // Sort type
        // Datatable column number to table column name mapping
        $arr = ['id', 'company_name'];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $company = Company::where('company_name', 'like', '%' . $sSearch . '%')
                ->orWhere('company_name', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Company::where('company_name', 'like', '%' . $sSearch . '%')->orWhere('company_name', 'like', '%' . $sSearch . '%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($company) > 0) {
            foreach ($company as $comp) {
                $action = '<a href="addCompany/' . $comp->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteCompany/' . $comp->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this company?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = [$comp->id, $comp->company_name, $action];
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save company details
     * @param void
     * @return array
     */
    public function saveCompany(Request $request, $cId = null) {
        if ($request->isMethod('get')) {
            $CompanyDetails = "";
            $button = 'Add';
            if (!empty($cId)) {
                $button = 'Update';
                $CompanyDetails = Company::where(['id' => $cId])->first();
            }
//                        prd($CompanyDetails);

            return view('admin.company.addCompany', ['CompanyDetails' => $CompanyDetails, 'button' => $button]);
        }
        /* ADD/EDIT COMPANY */
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $cId = ($request->input('savebtn') == 'Update') ? $cId : '';
            $CompanyDetails = ($request->input('savebtn') == 'Add') ? new Company() : Company::where(['id' => $cId])->first();

            $CompanyDetails->company_name = !empty($postData['company_name']) ? $postData['company_name'] : $CompanyDetails->company_name;

            $companyLogo = $request->file('company_logo');
            if (!empty($companyLogo)) {
                $logoFileName = upload_admin_images($companyLogo, 'vehicle');
                if (!empty($logoFileName)) {
                    $CompanyDetails->company_logo = $logoFileName;
                }
            }

            if (($request->input('savebtn') == 'Add')) {
                $CompanyDetails->created_at = date('Y-m-d H:i:s');
                $CompanyDetails->save();
                set_flash_message('Company Added Successfully.', 'alert-success');
            } else {
                $CompanyDetails->updated_at = date('Y-m-d H:i:s');
                $CompanyDetails->update();
                set_flash_message('Company Updated successfully', 'alert-success');
            }
            return redirect('admin/companies');
        }
    }

    /**
     * Function to fetch the selected Company details
     * @param void
     * @return array
     */
    public function getCompanyDetails(Request $request) {
        $companyId = $request->input('companyId');
        $companyDetails = Company::find($companyId);
        return response()->json($companyDetails);
    }

    /**
     * Function to delete Company
     * @param void
     * @return array
     */
    public function deleteCompany(Request $request, $companyId) {
        $company = Company::find($companyId);
        if ($company->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'company deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('admin/companies');
    }

}
