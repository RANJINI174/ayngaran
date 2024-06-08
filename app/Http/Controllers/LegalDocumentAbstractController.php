<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\ProjectDetail;
use App\Models\PlotManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LegalDocumentAbstractController extends Controller
{
    public function index()
    {
        try {
            $projects = Booking::leftjoin('project_details', 'project_details.id', 'booking.project_id')->select('project_details.*')->groupby('booking.project_id')->get();
            return view('legal_document_abstract.index', compact('projects'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function legal_abstract_lists(Request $request)
    {
         
        if ($request->project_id != "") {
            $html = '';

            if ($request->type == 'get-plot-nos') {
                
                $plots = '';
                 $plots = DB::table('plot_management as a')
                    ->leftJoin('project_details as b', 'b.id', '=', 'a.project_id')
                    ->where('a.project_id', $request->project_id)
                    ->where('a.deleted_at', '=', 0)->distinct()->select('a.*', 'b.short_name')
                    ->get();
                    $list = '';
                    $list = '<option value="">Select Plot No</option>';
                    
                    $selected = '';
                foreach($plots as $val)
                {
                    
                     
                    if(isset($request->plot_id))
                    {
                      if($val->id == $request->plot_id)
                    {
                        $selected = "selected";
                    }else{
                        $selected = '';
                    }  
                    }
                    
                    $list .= '<option value="'.$val->id.'" '.$selected.'>'.$val->plot_no.'</option>';
                }
                
                $plot_id = $request->plot_id;
                $get_plots = DB::table('plot_management as a')
                    ->leftJoin('project_details as b', 'b.id', '=', 'a.project_id')
                    ->where('a.project_id', $request->project_id);
                if ($request->plot_id != "") {
                    $get_plots->where('a.id', $request->plot_id);
                }
                $get_plots =  $get_plots->where('a.deleted_at', '=', 0)->select('a.*', 'b.short_name')
                    ->get();
                $total_plot_count = 0;
                if (isset($total_plot_count)) {
                    $total_plot_count = PlotManagement::where('project_id', $request->project_id);
                    if ($request->plot_id != "") {
                        $total_plot_count->where('id', $request->plot_id);
                    }
                    $total_plot_count =  $total_plot_count->where('deleted_at', '=', 0)->get()->count();
                }
                $i = 1;
                $total_plot_sqft = 0;
                foreach ($get_plots as $val) {
                    $total_plot_sqft += $val->plot_sq_ft;
                    $html .= '<tr>
                                        <td>' . $i++ . '</td>
                                        <td>' . $val->short_name . '</td>
                                        <td>' . $val->plot_no . '</td>
                                        <td style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">' . $val->plot_sq_ft . '</td>
                                    </tr>
                                 ';
                }
                $html .= '<tr>
                <td colspan="2"><h6 class="text-end fw-bold text-danger">Total :</h6></td>
                <td style="color: #6259ca;"><h6 class="fw-bold">' . $total_plot_count . '</h6></td>
                 <td style="color: #6259ca;"><h6 class="fw-bold">' . $total_plot_sqft . '</h6></td>
                </tr>';
                return response()->json(['status' => true, 'html' => $html, 'plots' => $plots,'list' => $list,'plot_id' => $plot_id], 200);
            }




            if ($request->type == 'register-completed-list') {
               
                $plots = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id') 
                                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')
                     ->whereNull('a.booking_status')
                    ->where('a.project_id', $request->project_id)->whereNotNull('a.register_status')
                    ->select('a.*', 'b.*', 'c.short_name')->get();
                    $list = '';
                    $list = '<option value="">Select Plot No</option>';
                    
                    $selected = '';
                foreach($plots as $val)
                {
                    
                     
                    if(isset($request->plot_id))
                    {
                      if($val->id == $request->plot_id)
                    {
                        $selected = "selected";
                    }else{
                        $selected = '';
                    }  
                    }
                    
                    $list .= '<option value="'.$val->id.'" '.$selected.'>'.$val->plot_no.'</option>';
                }
                

                $reg_completed = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id') 
                                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')
                                ->whereNull('a.booking_status')
                    ->where('a.project_id', $request->project_id);
                if ($request->plot_id != "") {
                    $reg_completed->where('a.plot_id', $request->plot_id);
                }
                $reg_completed = $reg_completed->whereNotNull('a.register_status')
                    ->select('a.*', 'b.*', 'c.short_name')->distinct()->get();
                // dd($reg_completed);
                $reg_completed_count = 0;
                if (isset($reg_completed_count)) {
                    $reg_completed_count = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')
                        ->where('a.project_id', $request->project_id)->whereNull('a.booking_status');
                        if ($request->plot_id != "") {
                            $reg_completed_count->where('a.plot_id', $request->plot_id);
                        }
                        $reg_completed_count = $reg_completed_count->whereNotNull('a.register_status')->select('a.*', 'b.*', 'c.short_name')->get()->count();
                }
                $i = 1;
                $total_reg_plot_sqft = 0;
                foreach ($reg_completed as $val) {
                    $total_reg_plot_sqft += $val->plot_sq_ft;
                    $html .= '<tr>
                                        <td>' . $i++ . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
                                        <td>' . $val->short_name . '</td>
                                        <td>' . $val->plot_no . '</td>
                                        <td>' . $val->plot_sq_ft . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->register_date)) . '</td>
                                    </tr>
                                 ';
                }
                $html .= '<tr>
                <td colspan="3"><h6 class="text-end fw-bold text-danger">Total :</h6></td>
                <td style="color: #6259ca;"><h6 class="fw-bold">' . $reg_completed_count . '</h6></td>
                 <td style="color: #6259ca;"><h6 class="fw-bold">' . $total_reg_plot_sqft . '</h6></td>
                 <td></td>
                </tr>';
                return response()->json(['status' => true, 'html' => $html, 'plots' => $plots,'list' => $list], 200);
            }



            if ($request->type == 'register-doc-office-list') {
                
                $plots = DB::table('booking as a')
                    ->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                    ->whereNull('a.booking_status')
                    ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->where('a.project_id', $request->project_id)
                    ->whereNotNull('a.doc_receive_status')->whereNull('a.doc_issue_status')
                    ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->get();
                    
                
                    $list = '';
                    $list = '<option value="">Select Plot No</option>';
                    
                    $selected = '';
                foreach($plots as $val)
                {
                    
                     
                    if(isset($request->plot_id))
                    {
                      if($val->id == $request->plot_id)
                    {
                        $selected = "selected";
                    }else{
                        $selected = '';
                    }  
                    }
                    
                    $list .= '<option value="'.$val->id.'" '.$selected.'>'.$val->plot_no.'</option>';
                }
                

                    
                $reg_doc_off_list = DB::table('booking as a')
                    ->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                    ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')
                    ->whereNull('a.booking_status')->where('a.project_id', $request->project_id);
                    if ($request->plot_id != "") {
                        $reg_doc_off_list->where('a.plot_id', $request->plot_id);
                    }
                    $reg_doc_off_list = $reg_doc_off_list->whereNotNull('a.doc_receive_status')->whereNull('a.doc_issue_status')
                    ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->get();

                $reg_off_list_count = 0;
                if (isset($reg_off_list_count)) {
                    $reg_off_list_count = DB::table('booking as a')
                        ->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')
                        ->whereNull('a.booking_status')->where('a.project_id', $request->project_id);
                        if ($request->plot_id != "") {
                            $reg_off_list_count->where('a.plot_id', $request->plot_id);
                        }
                        $reg_off_list_count = $reg_off_list_count->whereNotNull('a.doc_receive_status')->whereNull('a.doc_issue_status')->select('a.*', 'b.*', 'c.short_name')->get()->count();
                }
                $i = 1;
                $total_reg_plot_sqft = 0;
                $customer_name = '';
                $customer_mobile = '';
                foreach ($reg_doc_off_list as $val) {
                    $total_reg_plot_sqft += $val->plot_sq_ft;

                    $booking = Booking::where('project_id', $val->b_project_id)->where('plot_id', $val->b_plot_id)->first();
                    if (isset($booking->customer_id)) {
                        $get_customer_details = Booking::where('id', $booking->customer_id)->first();
                        if (isset($get_customer_details)) {
                            $customer_name = $get_customer_details->customer_name;
                            $customer_mobile = $get_customer_details->mobile;
                        }
                    } else {
                        $customer_name = $booking->customer_name;
                        $customer_mobile = $booking->mobile;
                    }
                    $html .= '<tr>
                                     <td>' . $i++ . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
                                        <td>' . $val->short_name . '</td>
                                        <td>' . $val->plot_no . '</td>
                                        <td>' . $val->plot_sq_ft . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->register_date)) . '</td>
                                        <td>' . $customer_name . '</td>
                                        <td>' . $customer_mobile . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->doc_collected_date)) . '</td>
                                    </tr>
                                 ';
                }
                $html .= '<tr>
                <td colspan="3"><h6 class="text-end fw-bold text-danger">Total :</h6></td>
                <td style="color: #6259ca;"><h6 class="fw-bold">' . $reg_off_list_count . '</h6></td>
                 <td style="color: #6259ca;"><h6 class="fw-bold">' . $total_reg_plot_sqft . '</h6></td>
                 <td colspan="4"></td>
                </tr>';
                return response()->json(['status' => true, 'html' => $html,'plots'=>$plots,'list' => $list], 200);
            }




            if ($request->type == 'register-doc-issued-list') {
                 
                 $plots = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->whereNull('a.booking_status')->where('a.project_id', $request->project_id)
                ->whereNotNull('a.doc_issue_status') 
                ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->get();
                
                   $list = '';
                    $list = '<option value="">Select Plot No</option>';
                    
                    $selected = '';
                foreach($plots as $val)
                {
                    
                     
                    if(isset($request->plot_id))
                    {
                      if($val->id == $request->plot_id)
                    {
                        $selected = "selected";
                    }else{
                        $selected = '';
                    }  
                    }
                    
                    $list .= '<option value="'.$val->id.'" '.$selected.'>'.$val->plot_no.'</option>';
                }
                
                
                $reg_doc_issued_list = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->whereNull('a.booking_status')->where('a.project_id', $request->project_id);
                if ($request->plot_id != "") {
                    $reg_doc_issued_list->where('a.plot_id', $request->plot_id);
                }
                $reg_doc_issued_list = $reg_doc_issued_list->whereNotNull('a.doc_issue_status') 
                ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->get();

                $reg_doc_issued_count = 0;
                if (isset($reg_doc_issued_count)) {
                    $reg_doc_issued_count = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                    ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->whereNull('a.booking_status')->where('a.project_id', $request->project_id);
                    if ($request->plot_id != "") {
                        $reg_doc_issued_count->where('a.plot_id', $request->plot_id);
                    }
                    $reg_doc_issued_count = $reg_doc_issued_count->whereNotNull('a.doc_issue_status')->select('a.*', 'b.*', 'c.short_name')->get()->count();
                }
                $i = 1;
                $total_issue_plot_sqft = 0;
                $customer_name = '';
                $customer_mobile = '';
                foreach ($reg_doc_issued_list as $val) {
                    $total_issue_plot_sqft += $val->plot_sq_ft;

                    $booking = Booking::where('project_id', $val->b_project_id)->where('plot_id', $val->b_plot_id)->first();
                    if (isset($booking->customer_id)) {
                        $get_customer_details = Booking::where('id', $booking->customer_id)->first();
                        if (isset($get_customer_details)) {
                            $customer_name = $get_customer_details->customer_name;
                            $customer_mobile = $get_customer_details->mobile;
                        }
                    } else {
                        $customer_name = $booking->customer_name;
                        $customer_mobile = $booking->mobile;
                    }

                    $html .= '<tr>
                                     <td>' . $i++ . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
                                        <td>' . $val->short_name . '</td>
                                        <td>' . $val->plot_no . '</td>
                                        <td>' . $val->plot_sq_ft . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->register_date)) . '</td>
                                        <td>' . $customer_name . '</td>
                                        <td>' . $customer_mobile . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->doc_collected_date)) . '</td>
                                    </tr>
                                 ';
                }
                $html .= '<tr>
                <td colspan="3"><h6 class="text-end fw-bold text-danger">Total :</h6></td>
                <td style="color: #6259ca;"><h6 class="fw-bold">' . $reg_doc_issued_count . '</h6></td>
                 <td style="color: #6259ca;"><h6 class="fw-bold">' . $total_issue_plot_sqft . '</h6></td>
                 <td colspan="4"></td>
                </tr>';
                return response()->json(['status' => true, 'html' => $html,'plots'=>$plots,'list' => $list], 200);
            }



            if ($request->type == 'legal-book-office-list') {
                
                $plots = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->where('a.project_id', $request->project_id)
                ->whereNotNull('a.doc_issue_status')->whereNull('a.legal_issue_status')->whereNull('a.booking_status')
                ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->get();
                
                
                $list = '';
                    $list = '<option value="">Select Plot No</option>';
                    
                    $selected = '';
                foreach($plots as $val)
                {
                    
                     
                    if(isset($request->plot_id))
                    {
                      if($val->id == $request->plot_id)
                    {
                        $selected = "selected";
                    }else{
                        $selected = '';
                    }  
                    }
                    
                    $list .= '<option value="'.$val->id.'" '.$selected.'>'.$val->plot_no.'</option>';
                }
                
                 $reg_doc_off_list = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->where('a.project_id', $request->project_id)->whereNull('a.booking_status');
                if ($request->plot_id != "") {
                    $reg_doc_off_list->where('a.plot_id', $request->plot_id);
                }
                $reg_doc_off_list = $reg_doc_off_list->whereNotNull('a.doc_issue_status')->whereNull('a.legal_issue_status')->whereNull('a.booking_status')
                ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->get();

                    $reg_doc_off_list_count = 0;
                if (isset($reg_doc_off_list_count)) {
                    $reg_doc_off_list_count = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                    ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->where('a.project_id', $request->project_id)->whereNull('a.booking_status');
                    if ($request->plot_id != "") {
                        $reg_doc_off_list_count->where('a.plot_id', $request->plot_id);
                    }
                    $reg_doc_off_list_count = $reg_doc_off_list_count->whereNotNull('a.doc_issue_status')->whereNull('a.legal_issue_status')->whereNull('a.booking_status')
                    ->select('a.*', 'b.*', 'c.short_name')->get()->count();
                }

                $i = 1;
                $total_reg_doc_plot_sqft = 0;
                $customer_name = '';
                $customer_mobile = '';
                foreach ($reg_doc_off_list as $val) {
                    $total_reg_doc_plot_sqft += $val->plot_sq_ft;

                    $booking = Booking::where('project_id', $val->b_project_id)->where('plot_id', $val->b_plot_id)->first();
                    if (isset($booking->customer_id)) {
                        $get_customer_details = Booking::where('id', $booking->customer_id)->first();
                        if (isset($get_customer_details)) {
                            $customer_name = $get_customer_details->customer_name;
                            $customer_mobile = $get_customer_details->mobile;
                        }
                    } else {
                        $customer_name = $booking->customer_name;
                        $customer_mobile = $booking->mobile;
                    }
                    $html .= '<tr>
                                     <td>' . $i++ . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
                                        <td>' . $val->short_name . '</td>
                                        <td>' . $val->plot_no . '</td>
                                        <td>' . $val->plot_sq_ft . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->register_date)) . '</td>
                                        <td>' . $customer_name . '</td>
                                        <td>' . $customer_mobile . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->doc_collected_date)) . '</td>
                                    </tr>
                                 ';
                }
                $html .= '<tr>
                <td colspan="3"><h6 class="text-end fw-bold text-danger">Total :</h6></td>
                <td style="color: #6259ca;"><h6 class="fw-bold">' . $reg_doc_off_list_count . '</h6></td>
                 <td style="color: #6259ca;"><h6 class="fw-bold">' . $total_reg_doc_plot_sqft . '</h6></td>
                 <td colspan="4"></td>
                </tr>';
                return response()->json(['status' => true, 'html' => $html, 'plots'=>$plots, 'list' => $list], 200);
            }




            if ($request->type == 'legal-book-issued-list') {
                
                $plots = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->where('a.project_id', $request->project_id)
                ->whereNotNull('a.legal_issue_status')->whereNull('a.booking_status')
                ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->distinct()->get();
                
                
                $list = '';
                    $list = '<option value="">Select Plot No</option>';
                    
                    $selected = '';
                foreach($plots as $val)
                {
                    
                     
                    if(isset($request->plot_id))
                    {
                      if($val->id == $request->plot_id)
                    {
                        $selected = "selected";
                    }else{
                        $selected = '';
                    }  
                    }
                    
                    $list .= '<option value="'.$val->id.'" '.$selected.'>'.$val->plot_no.'</option>';
                }
                
                
                $legal_book_issued_list = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->where('a.project_id', $request->project_id)
                ->whereNull('a.booking_status');
                if ($request->plot_id != "") {
                    $legal_book_issued_list->where('a.plot_id', $request->plot_id);
                }
                $legal_book_issued_list = $legal_book_issued_list->whereNotNull('a.legal_issue_status')
                ->select('a.*', 'b.*', 'c.short_name', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')->distinct()->get();

                $legal_book_issued_list_count = 0;
                if (isset($legal_book_issued_list_count)) {
                    $legal_book_issued_list_count = DB::table('booking as a')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                    ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')->where('a.project_id', $request->project_id)
                    ->whereNull('a.booking_status');
                    if ($request->plot_id != "") {
                        $legal_book_issued_list_count->where('a.plot_id', $request->plot_id);
                    }
                    $legal_book_issued_list_count = $legal_book_issued_list_count->whereNotNull('a.legal_issue_status')->select('a.*', 'b.*', 'c.short_name')->get()->count();
                }
                $i = 1;
                $total_legal_plot_sqft = 0;
                $customer_name = '';
                $customer_mobile = '';
                foreach ($legal_book_issued_list as $val) {
                    $total_legal_plot_sqft += $val->plot_sq_ft;
                    $booking = Booking::where('project_id', $val->b_project_id)->where('plot_id', $val->b_plot_id)->first();
                      if (isset($booking->issued_to_name)) {
    
                            if (isset($booking->issued_to_name)) {
                                $customer_name = $booking->issued_to_name;
                                $customer_mobile = $booking->issued_to_mobile;
                            } else {
                                $customer_name = $booking->issued_to_name;
                                $customer_mobile = $booking->issued_to_mobile;
                            }
                        } else {
                            if (isset($booking->customer_id)) {
                                $get_customer_details = Booking::where('id', $booking->customer_id)->first();
                                if (isset($get_customer_details)) {
                                    $customer_name = $get_customer_details->customer_name;
                                    $customer_mobile = $get_customer_details->mobile;
                                }
                            } else {
                                $customer_name = $booking->customer_name;
                                $customer_mobile = $booking->mobile;
                            }
                        }
                    $html .= '<tr>
                                     <td>' . $i++ . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
                                        <td>' . $val->short_name . '</td>
                                        <td>' . $val->plot_no . '</td>
                                        <td>' . $val->plot_sq_ft . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->register_date)) . '</td>
                                        <td>' . $customer_name . '</td>
                                        <td>' . $customer_mobile . '</td>
                                        <td>' . date('d-m-Y', strtotime($val->doc_collected_date)) . '</td>
                                    </tr>
                                 ';
                }
                $html .= '<tr>
                <td colspan="3"><h6 class="text-end fw-bold text-danger">Total :</h6></td>
                <td style="color: #6259ca;"><h6 class="fw-bold">' . $legal_book_issued_list_count . '</h6></td>
                 <td style="color: #6259ca;"><h6 class="fw-bold">' . $total_legal_plot_sqft . '</h6></td>
                 <td colspan="4"></td>
                </tr>';
                return response()->json(['status' => true, 'html' => $html,'plots'=>$plots,'list' => $list], 200);
            }
        }
    }
    
 
}