<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ProjectDetail;
use App\Models\User;
use App\Models\PlotDocumentIssueList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlotDocumentIssueController extends Controller
{
    public function index()
    {
        try {

            $projects = Booking::select('project_details.id as id', 'project_details.short_name')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                ->leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')->whereNull('booking.booking_status')->where('booking.fully_paid_status', 1)
                ->where('booking.confirm_status', 1)->where('booking.register_status', 1)->where('booking.doc_receive_status', 1)->whereNull('booking.doc_issue_status')
                ->distinct()->get();
            return view('plot_document_issue.index', compact('projects'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function get_plot_nos(Request $request)
    {
        if ($request->project_id != "") {
            $plot_nos =
                Booking::leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')->whereNull('booking.booking_status')
                ->where('booking.fully_paid_status', 1)->where('booking.confirm_status', 1)->where('booking.register_status', 1)
                ->where('booking.doc_receive_status', 1)->whereNull('booking.doc_issue_status')->where('booking.project_id', $request->project_id)->get();
            return response()->json(['status' => true, 'plot_nos' => $plot_nos], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
        }
    }
    
    public function get_plot_sqft(Request $request)
    {
        if ($request->plot_id != "") {
            $get_plot = DB::table("booking as a")
                ->select("a.*", "b.*", '.a.id as booking_id','c.*')
                ->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->leftJoin('project_details as c', 'c.id', '=', 'a.project_id')
                ->where('a.doc_receive_status', '=', 1)
                // ->whereNull('a.doc_issue_status')
                ->where('a.plot_id', '=', $request->plot_id)
                ->first();
      
            $register_date = '';
            if (isset($get_plot->register_date)) {
                $register_date = date('d-m-Y', strtotime($get_plot->register_date));
            }
            $doc_collected_date = '';
            if (isset($get_plot->doc_collected_date)) {
                $doc_collected_date = date('d-m-Y', strtotime($get_plot->doc_collected_date));
            }


            $customer_name = '';
            $customer_mobile = '';
            if (isset($get_plot->customer_id)) {
                $customer_id = $get_plot->customer_id;
                $get_customer_details = Booking::where('id', $get_plot->customer_id)->first();
                if (isset($get_customer_details)) {
                    $customer_name = $get_customer_details->customer_name;
                    $customer_mobile = $get_customer_details->mobile;
                }
            } else {
                $customer_name = $get_plot->customer_name;
                $customer_mobile = $get_plot->mobile;
            }
            $get_collected_by = User::where('id', $get_plot->doc_collected_by)->first();
            $doc_collected_by = '';
            if (isset($get_collected_by)) {
                $doc_collected_by = $get_collected_by->name;
            }

          $doc_issue = PlotDocumentIssueList::where('project_id', $request->project_id)->where('plot_id', $request->plot_id)->orderBy('id', 'desc')->first();
          $doc_issue_count = PlotDocumentIssueList::where('project_id', $request->project_id)->where('plot_id', $request->plot_id)->orderBy('id', 'desc')->get()->count();
          $document_image = '';
          
          if(!empty($doc_issue) && $doc_issue != null){
              $document_image = $doc_issue -> document_issued_file;
          }

        return response()->json(['status' => true, 'get_plot' => $get_plot, 'customer_name' => $customer_name, 'mobile' => $customer_mobile,
       'register_date' => $register_date, 'doc_collected_date' => $doc_collected_date, 'doc_collected_by' => $doc_collected_by,
       'document_image'=>$document_image,'doc_issue_count'=>$doc_issue_count], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
        }
    }

   public function store(Request $request)
    {
        $request->validate([
            'get_project_id' => 'required',
            'get_plot_no' => 'required',
            'booking_id' => 'required',
        ]);

        if (
            !empty($request->booking_id) && $request->booking_id != "" && !empty($request->get_project_id) && $request->get_project_id != ""
            && !empty($request->get_plot_no) && $request->get_plot_no != ""
        ) {
            $booking_id = $request->booking_id;
            $project_id = $request->get_project_id;
            $plot_id = $request->get_plot_no;
            $data = [];
            $data['doc_issue_status'] = 1;
            $update = Booking::where("id", $booking_id)->where('project_id', $project_id)->where('plot_id', $plot_id)->update($data);
            if ($update) {
                return response()->json(['status' => true, 'message' => 'Plot Document Issued Successfully!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Plot Document Issued Failed!']);
            }
        }
        return response()->json(['status' => false, 'message' => 'Plot Document Issued Failed!']);
    }
    
     public function plot_doc_issue_page()
    {
        try {
            // $projects = ProjectDetail::all();
            $projects = Booking::select('project_details.id AS id', 'project_details.short_name')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                ->leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')->whereNull('booking.booking_status')
                ->where('booking.fully_paid_status', 1)->where('booking.confirm_status', 1)
                ->where('booking.register_status', 1)->where('booking.doc_receive_status', 1)
                ->where('booking.doc_issue_status', 1)->whereNull('booking.legal_issue_status')
                ->distinct()->get();
                
            return view('plot_doc_issue_document.index', compact('projects'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
        public function get_document_issue_plots(Request $request)
    {
        if ($request->project_id != "") {
            $plot_nos =
                Booking::leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')->whereNull('booking.booking_status')
                ->where('booking.fully_paid_status', 1)->where('booking.confirm_status', 1)->where('booking.register_status', 1)
                ->where('booking.doc_receive_status', 1)->whereNotNull('booking.doc_issue_status')->whereNull('booking.legal_issue_status')->where('booking.project_id', $request->project_id)->get();
            return response()->json(['status' => true, 'plot_nos' => $plot_nos], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
        }
    }
    
    public function plot_document_issued_store(Request $request){
        $request->validate([
            'booking_id' => 'required',
            'get_project_id' => 'required',
            'get_plot_no' => 'required',
            // 'plot_sq_ft' => 'required',
            // 'customer_name' => 'required',
            // 'customer_mobile' => 'required',
            // 'reg_no' => 'required',
            // 'reg_date' => 'required',
            // 'collected_by' => 'required',
            // 'collected_date' => 'required',
            // 'reg_expense_by' => 'required',
            // 'issued_name' => 'required',
            // 'issued_mobile' => 'required',
            'document_issued_file'=>'required',
        ]);
        
        $doc_issue_count = PlotDocumentIssueList::where('project_id', $request->get_project_id)->where('plot_id', $request->get_plot_no)->orderBy('id', 'desc')->get()->count();
        if($doc_issue_count > 0){
            return response()->json(['status' => false, 'message' => 'Plot Document  Already Issued!']);
        }
        
        $inputDate = $request->reg_date;
        $parsedDate = \DateTime::createFromFormat('Y-m-d', $inputDate);
        
        $collectedDate = $request->doc_collected_date;
        $colparsedDate = \DateTime::createFromFormat('Y-m-d', $collectedDate);
        
        $imageName = 'DOC-'.time().'.'.$request->document_issued_file->extension();  
        $request->document_issued_file->move(public_path('assets/images/plot_document_issued'), $imageName);
        $document = new PlotDocumentIssueList();
        $document->booking_id = $request->booking_id;
        $document->project_id = $request->get_project_id;
        $document->plot_id = $request->get_plot_no;
        $document->plot_sq_ft = $request->plot_sq_val;
        $document->customer_name = $request->customer_name;
        $document->customer_mobile = $request->mobile_no;
        $document->reg_no = $request->reg_no;
        
        if ($parsedDate === false) {
            $document->reg_date = date('Y-m-d');
        } else {
            $document->reg_date = $parsedDate->format('Y-m-d');
        }

        $document->collected_by = $request->doc_collected_by;
        if ($parsedDate === false) {
            $document->collected_date = date('Y-m-d');
        } else {
            $document->collected_date = $colparsedDate->format('Y-m-d');
        }

        $document->reg_expense_by = $request->reg_expense_by;
        $document->issued_name = $request->issue_to_name;
        $document->issued_mobile = $request->issue_to_mobile_no;
        $document->document_issued_file = $imageName;
        $document->status = 1;

        $insert = $document->save();
        if($insert){
             return response()->json(['status' => true, 'message' => 'Plot Document Issued - Document Successfully!'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Plot Document Issued Document Failed!'], 400);
        }
    }
    
}
