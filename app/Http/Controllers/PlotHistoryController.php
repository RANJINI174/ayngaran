<?php

namespace App\Http\Controllers;
use \App\Models\ProjectDetail;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Pincode;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PlotHistoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $projects =
                Booking::leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
                ->select('project_details.id', 'project_details.short_name')->distinct('booking.project_id')->get();

            return view('reports.plot_history', compact('projects'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function get_plot_nos(Request $request)
    {
        if ($request->project_id != "") {
            $project_id = $request->project_id;
            $plot_nos = DB::table('booking as a')->select('c.*')->leftJoin('plot_management as c', 'c.id', '=', 'a.plot_id')
            ->where('c.deleted_at','=',0)
            ->whereNull('booking_status')
                ->where('a.project_id', $project_id)->get();

            return response()->json(['status' => true, 'plot_nos' => $plot_nos], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }

    public function get_plot_history(Request $request)
    {
        $project_id = $request->project_id;
        $plot_id = $request->plot_id;

        $customer_name = '';
        $gender = '';
        $relation_ship = '';
        $mobile = '';
        $relation_name = '';
        $alternate_mobile = '';
        $customer_address = '';
        $area = '';
        $city = '';
        $state = '';
        $pincode = '';
        if (!empty($project_id) && !empty($plot_id)) {

            //customer details
            $booking = Booking::where('project_id', $project_id)->where('plot_id', $plot_id)->first();

            if (isset($booking->customer_id)) {
                $get_customer_details = Booking::where('id', $booking->customer_id)->first();
                if (isset($get_customer_details)) {
                    $customer_name = $get_customer_details->customer_name;
                    $mobile = $get_customer_details->mobile;
                    $alternate_mobile = $get_customer_details->alternate_mobile;
                    
                    $get_area = Pincode::where('id',$get_customer_details->area)->first();
                    if(isset($get_area))
                    {
                        $area = $get_area->area;
                        $city = $get_area->city;
                        $state = $get_area->state;
                        $pincode = $get_area->pincode;
                    }
                    $customer_address = $get_customer_details->street.','.$area.','.$city.','.$state. ' - '.$pincode;
                    if ($get_customer_details->gender == 1) {
                        $gender = 'Male';
                    } else if ($get_customer_details->gender == 0) {
                        $gender = 'Female';
                    }
                    
                    
                    if ($get_customer_details->select == 1) {
                        $relation_ship = 'S/O   ';
                    } else if ($get_customer_details->select == 2) {
                        $relation_ship = 'D/O   ';
                        
                    }
                    else if ($get_customer_details->select == 3) {
                        $relation_ship = 'W/O   ';
                    }
                    else if ($get_customer_details->select == 4) {
                        $relation_ship = 'C/O   ';
                    }
                    
                   $relation_name = $get_customer_details->relation_name; 
                }
            } else {
                $customer_name = $booking->customer_name;
                $gender = $booking->gender;
                $mobile = $booking->mobile;
                $alternate_mobile = $booking->alternate_mobile;
                $customer_address = $booking->street;
                if ($booking->gender == 1) {
                    $gender = 'Male';
                } else if ($booking->gender == 0) {
                    $gender = 'Female';
                }
                
                   $get_area = Pincode::where('id',$booking->area)->first();
                    if(isset($get_area))
                    {
                        $area = $get_area->area;
                        $city = $get_area->city;
                        $state = $get_area->state;
                        $pincode = $get_area->pincode;
                    }
                    $customer_address = $booking->street.','.$area.','.$city.','.$state. ' - '.$pincode;
                
                   if ($booking->select == 1) {
                        $relation_ship = 'S/O  ';
                    } else if ($booking->select == 2) {
                        $relation_ship = 'D/O  ';
                    }
                    else if ($booking->select == 3) {
                        $relation_ship = 'W/O   ';
                    }
                    else if ($booking->select == 4) {
                        $relation_ship = 'C/O  ';
                    }
                    
                    $relation_name = $booking->relation_name;
            }

            //plot details
            $plot =  DB::table('plot_management')
                ->where('project_id', $project_id)->where('id', $plot_id)->where('deleted_at', '=', 0)->first();

            $plot_no = '';
            $total_plot_sqft = '';
            $cent_value = '';
            $sqft_rate = '';
            $plot_value = '';
            if (isset($plot)) {
                $plot_no = $plot->plot_no;
                $total_plot_sqft = $plot->plot_sq_ft;

                $cent = $total_plot_sqft / 435.56;
                $cent_value = $cent;
                $sqft_rate = IND_money_format(($plot->market_value_sq_ft));
                $plot_value = IND_money_format(round($plot->market_value_plot_rate));
            }
            // marketer details
            $marketer_name = '';
            $marketer_id = '';
            $marketer_mobile = '';
            $html = '';
            if (isset($booking->marketer_id)) {
                $markter = User::where('id', $booking->marketer_id)->first();
                if($markter->user_type != 'director')
                {
                
                if (isset($markter)) {
                    $marketer_id = $markter->reference_code;
                    $marketer_name = $markter->name;
                    $marketer_mobile = $markter->mobile_no;
                } else {
                    $marketer_id = $booking->marketer_code;
                    $marketer_name = $booking->marketer_name;
                    $marketer_mobile = $booking->marketer_mobile;
                }
                if (isset($markter->director_id)) {
                    $director = User::where('id', $markter->director_id)->first();
                    $html .= '<tr><td>#</td><td>' . $director->user_type . '</td><td>' . $director->reference_code . '</td><td>' . $director->name . '</td><td>'
                        . $director->mobile_no . '</td></tr>';
                }
                if (isset($markter->marketing_manager_id)) {
                    $manager = User::where('id', $markter->marketing_manager_id)->first();
                    $html .= '<tr><td>#</td><td>' . $manager->user_type . '</td><td>' . $manager->reference_code . '</td><td>' . $manager->name . '</td><td>'
                        . $manager->mobile_no . '</td></tr>';
                }
                if (isset($markter->marketing_supervisor_id)) {
                    $supervisor = User::where('id', $markter->marketing_supervisor_id)->first();
                    $html .= '<tr><td>#</td><td>' . $supervisor->user_type . '</td><td>' . $supervisor->reference_code . '</td><td>' . $supervisor->name . '</td><td>'
                        . $supervisor->mobile_no . '</td></tr>';
                }
                if (isset($markter->marketing_executive_id)) {
                    $executive = User::where('id', $markter->marketing_executive_id)->first();
                    $html .= '<tr><td>#</td><td>' . $executive->user_type . '</td><td>' . $executive->reference_code . '</td><td>' . $executive->name . '</td><td>'
                        . $executive->mobile_no . '</td></tr>';
                }
                    
                }else{
                    $get_director = \App\Models\User::where('id', $markter->id)->first();
                    $html .= '<tr><td style="font-size:13px;text-align:center;">#</td><td style="font-size:13px;text-align:center;">' . $get_director->user_type . '</td>
                    <td style="font-size:13px;text-align:center;">' . $get_director->reference_code . '</td>
                    <td style="font-size:13px;text-align:center;">' . $get_director->name . '</td><td>'
                        . $get_director->mobile_no . '</td></tr>';
                        
                    $marketer_id = $get_director->reference_code;
                    $marketer_name = $get_director->name;
                    $marketer_mobile = $get_director->mobile_no;
                }
            }

            // registration details
            $reg_no = '';
            $reg_date = '';
            $doc_collected_by = '';
            $reg_mobile = '';
            $doc_collected_date = '';
            $doc_collected_mobile = '';
            $reg_count = Booking::where('project_id', $project_id)->where('plot_id', $plot_id)->whereNotnull('register_status')->get()->count();
            if (isset($booking)) {
                $reg_no = $booking->reg_no;
                if(isset($booking->register_date))
                {
                  $reg_date = date('d-m-Y',strtotime($booking->register_date));  
                }else{
                    $reg_date = '';
                }
                if(isset($booking->doc_collected_date))
                {
                  $doc_collected_date = date('d-m-Y',strtotime( $booking->doc_collected_date));
                }else{
                   $doc_collected_date = '';
                }
                
                
                $doc_collected = User::where('id', $booking->doc_collected_by)->first();
                if (isset($doc_collected)) {
                    $doc_collected_by = $doc_collected->name;
                    $doc_collected_mobile = $doc_collected->mobile_no;
                }
            }
            $customer_doc_list = Booking::where('project_id', $project_id)->where('plot_id', $plot_id)
                ->whereNotnull('doc_issue_status')->whereNotnull('legal_issue_status')->get()->count();

            // payment details
            $payment_details = '';
            $pay_mode = '';
            $type = '';
            $narration = '';
            $total_amt = 0;
            $sno = 1;
            $total_discount_amt = 0;
            $grant_total_amt = 0;
            $total_paid_amt = 0;
            $pay_term = '';
            $cheque_nos = '';
            $loan_amount = '';
            $bank_name = '';
            $new_pay_term = '';
            $pay_towards = [];
            $amount_towards = '';
            $payments = Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->get();

            if (isset($payments)) {
                foreach ($payments as $val) {
                    if ($val->pay_mode == 1) {
                        $pay_mode = 'Cash';
                    }
                    if ($val->pay_mode == 2) {
                        $pay_mode = 'Cheque';
                    }
                    if ($val->pay_mode == 3) {
                        $pay_mode = 'DD';
                    }
                    if ($val->pay_mode == 4) {
                        $pay_mode = 'Online Transfer';
                    }
                    if ($val->pay_mode == 5) {
                        $pay_mode = 'Cash Deposite';
                    }

                    if ($val->account_type == 1) {
                        $type = 'Part Payment';
                    } else {
                        $type = 'Advance';
                    }

                    if (isset($val->narration)) {
                        $narration = $val->narration;
                    } else {
                        if ($val->pay_mode != 1) {
                            if (isset($val->bank_name)) {
                                $bank = \App\Models\Bank::where('id', $val->bank_name)->first();
                                $narration = $bank->bank_name;
                            } else {
                                $narration = $val->narration;
                            }
                        } else {
                            $narration = $val->narration;
                        }
                    }

            if(isset($val->payment_term))
            {
              if($val->payment_term == 1)
                {
                    $pay_term = 'Own Fund';
                }else{
                    $pay_term = 'Bank Loan';
                }  
            }
             
                if(isset($val->payment_term))
              {
                if(isset($val->cheque_no))
                {
                if($pay_term == 'Bank Loan')
                {
                    $cheque_nos .= $val->cheque_no.',';
                }   
                }
              }
                
                if(isset($val->payment_term))
            {
                if($pay_term == 'Bank Loan')
                {
               if($val->amount_towards == 1)
                {
                    $amount_towards = 'MV';
                }else{
                    $amount_towards = 'GL';
                }
                
                array_push($pay_towards,$amount_towards);
                }
        
            }
                
                if(isset($val->payment_term))
            {
                if($pay_term == 'Bank Loan')
                {
                    $loan_amount .=  IND_money_format(round($val->amount)) .' ,';
                }
                
            }
            
            if(isset($val->payment_term))
            {
                
                if(isset($val->narration))
                {
                if($pay_term == 'Bank Loan')
                {
                    $bank_name .=  $val->narration .' ,';
                }    
                }else {
                  if (isset($val->bank_name)) {
                      if($pay_term == 'Bank Loan')
                  {
                   $bank = \App\Models\Bank::where('id', $val->bank_name)->first();
                    $bank_name .= $bank->bank_name .' ,';
                    
                }
                  } 
                }
                
            }
            
            if(isset($val->payment_term))
            {
                if($pay_term == 'Bank Loan')
                {
                    $new_pay_term =  $pay_term;
                }else{
                    $new_pay_term = 'Own Fund';
                }
            } 


                    // $total_amt = $val->amount - $val->discount;
                    $total_amt =  $val->discount + $val->amount;
                    $total_paid_amt += $val->amount;
                    $total_discount_amt += $val->discount;
                    
                    $payment_details .= '<tr>
                     <td style="text-align:center;">' . $sno++ . '</td>
                    <td style="text-align:center;">' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
                    <td style="text-align:center;">' . $val->receipt_no . '</td>
                    <td style="text-align:center;">' . $type . '</td>
                    <td style="text-align:center;">' . $pay_term . '</td>
                    <td style="text-align:center;">' . $pay_mode . '</td>
                    <td style="text-align:center;">' . $narration . '</td>
                    <td style="text-align:center;">' . IND_money_format(round($val->amount)) . '</td>
                    <td style="text-align:center;">' . IND_money_format(round($val->discount)) . '</td>
                    <td colspan="2" style="text-align:center;">' . IND_money_format(round($total_amt)) . '</td>
                    </tr>';
                    
                    $grant_total_amt += $total_amt;
                    
                }
            }

            $start_payment = Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->orderBy('receipt_date', 'asc')->first();
            $end_payment = Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->orderBy('receipt_date', 'desc')->first();
            $datetime1 = new DateTime($start_payment->receipt_date);
            $datetime2 = new DateTime($end_payment->receipt_date);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            $balance_amt = 0;
            $balance = Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->orderBy('id', 'desc')->first();
            if (isset($end_payment)) {
                $balance_amt =  IND_money_format(round($balance->balance));
            }
            // $total_paid_amt = 0;
            // // $total_paid = Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->selectRaw('SUM(amount + discount) AS total_paid_amount')->first();
            // $total_paid =   DB::table('part_payment')
            //     ->where('project_id', $project_id)
            //     ->where('plot_id', $plot_id)
            //     ->selectRaw('SUM(amount) + SUM(discount) AS total_paid_amount')
            //     ->first();
            // if (isset($total_paid)) {
            //     $total_paid_amt = $total_paid->total_paid_amount;
            // }

            return response()->json([
                'status' => true,'project_id'=>$project_id,'plot_id'=>$plot_id,
                'customer_name' => $customer_name,'relation_ship' => $relation_ship,'relation_name' => $relation_name, 'gender' => $gender, 'mobile' => $mobile, 'alternate_mobile' => $alternate_mobile, 'customer_address' => $customer_address,
                'plot_no' => $plot_no, 'total_plot_sqft' => $total_plot_sqft, 'cent' => $cent_value, 'sqft_rate' => $sqft_rate, 'plot_value' => $plot_value,
                'marketer_id' => $marketer_id, 'marketer_name' => $marketer_name, 'marketer_mobile' => $marketer_mobile, 'marketer_details' => $html,
                'reg_count' => $reg_count, 'reg_no' => $reg_no, 'reg_date' => $reg_date, 'doc_collected_by' => $doc_collected_by,
                'doc_collected_mobile' => $doc_collected_mobile, 'reg_mobile' => $reg_mobile, 'doc_collected_date' => $doc_collected_date, 'customer_doc_list' => $customer_doc_list,
                'payment_details' => $payment_details,'grant_total_amt' => IND_money_format(round($grant_total_amt)),'total_discount_amount'=>IND_money_format(round($total_discount_amt)),
                'number_of_days' => $days, 'balance' => $balance_amt, 'total_paid_amt' => IND_money_format(round($total_paid_amt)),'cheque_nos' => $cheque_nos ,'loan_amount' => $loan_amount
                ,'bank_name' => $bank_name,'pay_term' => $new_pay_term,'pay_towards' => $pay_towards
            ], 200);
        }

        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }
    
   public function plot_history_print_list(Request $request, $project_id, $plot_id)
    {
        try {
            $projects = ProjectDetail::all();
            return view('reports.plot_history_print', compact('projects', 'project_id', 'plot_id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

}
