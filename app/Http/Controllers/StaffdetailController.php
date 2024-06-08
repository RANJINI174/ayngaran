<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Designation;
use App\Models\Director;
use App\Models\MarketingExecutive;
use App\Models\MarketingManager;
use App\Models\MarketingSupervisor;
use App\Models\Pincode;
use App\Models\Bank;
use App\Models\Relationship;
use App\Models\Staff_Detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffdetailController extends Controller
{
    public function index()
    {
        try {
            $staff_details = User::leftjoin('designation', 'designation.id', 'users.designation_id')
                ->select('users.*', 'designation.designation' )->where('user_type', 'staff')->get();

            // $staff_details = User::where('user_type', 'staff')->get();
            return view('staff_details.index', compact('staff_details'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {
        try {
            $count = User::where('user_type', 'staff')->get()->count();
            $branch = Branch::where('status', 1)->get();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $banks = Bank::where('status',1)->get();
            return view('staff_details.add', compact('banks','count', 'branch', 'relations', 'designation'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function store(Request $request)
    {
        
//       $authkeyUrl = "https://api.authkey.io/request?";
//  $paramArray = Array(
//      'authkey' => 'AUKHKEY',
//      'mobile' => '8072432832',
//      'country_code' => '+91',
//      'sms' => 'Hello this is a test message',
//      'sender' => 'SENDERID'
//      );
 
//  $parameters = http_build_query($paramArray);
//  $url = $authkeyUrl . $parameters;
 
//  $curl = curl_init();
 
//  curl_setopt_array($curl, array(
//      CURLOPT_URL => $url,
//      CURLOPT_RETURNTRANSFER => true,
//  ));
 
//  $response = curl_exec($curl);
//  $err = curl_error($curl);
 
//  curl_close($curl);
 
//  if ($err) {
//      echo "cURL Error #:" . $err;
//  } else {
//      echo $response;
//  }
// exit
        $request->validate([
            'reference_code' => 'required',
            'name' => 'required',
            'father_husband_name' => 'required',
            'branch_id' => 'required',
            'join_date' => 'required',
            // 'introduced_by' => 'required',
            'marrital_status' => 'required',
            // 'wedding_date' => 'required',
            'nominee_name' => 'required',
            'relationship' => 'required',
            'nominee_mobile' => 'required|numeric|digits:10',
            'designation_id' => 'required',
            'mobile_no' => 'required|numeric|digits:10',
            'address' => 'required',
            'dob' => 'required',
            // 'gender' => 'required',
        ]);
        // if ($request->email != "") {
        //     $check_mail = User::where('email', $request->email)->get()->count();
        //     if ($check_mail > 0) {
        //         return response()->json(['status' => false, 'message' => 'Email Already Exist!']);
        //     }
        // }
        $check_mobile = User::where('mobile_no', $request->mobile_no)->get()->count();

        if ($check_mobile > 0) {
            return response()->json(['status' => false, 'message' => 'Mobile No Already Exist!']);
        }

        // if ($request->introduced_by == 'Thired Party') {
        //     $validate = $request->validate([
        //         // 'thired_party_name' => 'required',
        //         // 'thired_party_mobile' => 'required|numeric|digits:10',

        //     ]);
        // } else {
        //     $validate = $request->validate([
        //         // 'introducer' => 'required',

        //     ]);
        // }

        if ($request->password) {
            $password = Hash::make($request->password);
            $encrypt_password = encrypt($request->password);
        }


        $staff = new User();
        $staff->reference_code = $request->reference_code;
        $staff->name = $request->name;
        $staff->password = $password;
        $staff->encrypt_password = $encrypt_password;
        $staff->user_type = 'staff';
        $staff->designation_id = $request->designation_id;
        // $staff->team_name = $request->team_name;
        $staff->father_husband_name = $request->father_husband_name;
        $staff->branch_id = $request->branch_id;
        $staff->join_date = $request->join_date;
        $staff->marrital_status = $request->marrital_status;
        $staff->email = $request->email;
        $staff->wedding_date = $request->wedding_date;
        $staff->nominee_name = $request->nominee_name;
        $staff->nominee_mobile = $request->nominee_mobile;
        $staff->relationship = $request->relationship;
        $staff->address = $request->address;
        $staff->mobile_no = $request->mobile_no;
        $staff->alternate_mobile = $request->alternate_mobile;
        $staff->dob = $request->dob;
        $staff->gender = $request->gender;
        $staff->pincode = $request->pincode;
        $staff->area = $request->area;
        $staff->city_id = $request->city_id;
        $staff->state_id = $request->state_id;
        $staff->country_id = $request->country_id;
        $staff->bank_name = $request->bank_name;
        $staff->account_no = $request->account_no;
        $staff->ifsc_code = $request->ifsc_code;
        $staff->bank_branch = $request->bank_branch;
        $staff->introduced_by = $request->introduced_by;
        $staff->introducer_id = $request->introducer;
        $staff->thired_party_name = $request->thired_party_name;
        $staff->thired_party_mobile = $request->thired_party_mobile;
        $staff->status = $request->status;

        $insert =  $staff->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Staff Created Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Staff Creation Failed!']);
        }
    }

    public function edit($id)
    {
        if (!empty($id)) {
            $introducer_name = '';
            $introducer_id = '';
            $staff = User::where('user_type', 'staff')->where('id', $id)->first();
            if ($staff->introducer_by != 'thired_party') {
                $introducer_name = User::where('designation_id', $staff->introduced_by)->get();
                $introducer_id = User::where('id', $staff->introducer_id)->value('reference_code');
            }

            $branch = Branch::where('status', 1)->get();
            $relations = Relationship::where('status', 1)->get();
            $areas  = Pincode::where('pincode', $staff->pincode)->get();
            $state  = Pincode::select('id', 'state')->where('pincode', $staff->pincode)->first();
            $city  = Pincode::select('id', 'city')->where('pincode', $staff->pincode)->first();
            $designation = Designation::where('status', 1)->get();
            $banks = Bank::where('status',1)->get();

            return view('staff_details.edit', compact('banks','staff', 'areas', 'state', 'city', 'branch', 'relations', 'designation', 'introducer_id', 'introducer_name'));
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'reference_code' => 'required',
            'name' => 'required',
            'father_husband_name' => 'required',
            'branch_id' => 'required',
            'join_date' => 'required',
            // 'introduced_by' => 'required',
            'marrital_status' => 'required',
            // 'wedding_date' => 'required',
            'nominee_name' => 'required',
            'relationship' => 'required',
            'nominee_mobile' => 'required|numeric|digits:10',
            'designation_id' => 'required',
            'mobile_no' => 'required|numeric|digits:10',
            'address' => 'required',
            'dob' => 'required',
            // 'gender' => 'required',
        ], [
            'branch_id.required' => 'The branch field is required.',
            'designation_id.required' => 'The designation field is required',
        ]);
        
        $check_user_status =  User::where('mobile_no',$request->mobile_no)->where('id','!=',$id)->where('status',1)->get()->count();
        
        if($check_user_status != 0)
        {
            $designation = '';
            $get_user_desig = User::where('mobile_no',$request->mobile_no)->where('id','!=',$id)->where('status',1)->first();
            if(isset($get_user_desig))
            {
                $designation_get = Designation::where('id',$get_user_desig->designation_id)->first();
                $designation = $designation_get->designation;
            }
            return response()->json(['status' => false, 'message' => 'The User was Already Actived in '.$designation.' !']); 
        }  
        
        $data = [];
        if ($request->password) {
            $password = Hash::make($request->password);
            $encrypt_password = encrypt($request->password);
        }
        
         $status = $request->status;
        if(isset($request->promote_id))
        {
           $status = 0; 
        }
        
        if(isset($request->demote_id))
        {
            $status = 0;
        }
        
        $promote_id = '';
        $demote_id = '';
        if($request->select_type == 1)
        {
            $promote_id = $request->promote_id;
            $demote_id = '';
        }else{
             $demote_id = $request->demote_id;
            $promote_id = '';
        }
      

        // $check_mobile = User::where('mobile_no', $request->mobile_no)->where('id', '!=', $id)->get()->count();

        // if ($check_mobile > 0) {
        //     return response()->json(['status' => false, 'message' => 'Mobile No Already Exist!']);
        // }

        if ($request->introduced_by == 'thired_party') {
            $data['introducer_id'] = 0;
            $data['thired_party_name'] = $request->thired_party_name;
            $data['thired_party_mobile'] = $request->thired_party_mobile;
        } else {
            $data['introducer_id'] = $request->introducer;
            $data['thired_party_name'] = null;
            $data['thired_party_mobile'] = null;
        }
        $data['reference_code'] = $request->reference_code;
        $data['name'] = $request->name;
        $data['password'] = $password; 
        $data['encrypt_password'] = $encrypt_password; // Updated By Gowtham.s
        $data['user_type'] = 'staff';
        $data['designation_id'] = $request->designation_id;
        // $staff->team_name = $request->team_name;
        $data['father_husband_name'] = $request->father_husband_name;
        $data['branch_id'] = $request->branch_id;
        $data['join_date'] = $request->join_date;
        $data['marrital_status'] = $request->marrital_status;
        $data['email'] = $request->email;
        $data['wedding_date'] = $request->wedding_date;
        $data['nominee_name'] = $request->nominee_name;
        $data['nominee_mobile'] = $request->nominee_mobile;
        $data['relationship'] = $request->relationship;
        $data['address'] = $request->address;
        $data['mobile_no'] = $request->mobile_no;
        $data['alternate_mobile'] = $request->alternate_mobile;
        $data['dob'] = $request->dob;
        $data['gender'] = $request->gender;
        $data['pincode'] = $request->pincode;
        $data['area'] = $request->area;
        $data['city_id'] = $request->city_id;
        $data['state_id'] = $request->state_id;
        $data['country_id'] = $request->country_id;
        $data['bank_name'] = $request->bank_name;
        $data['account_no'] = $request->account_no;
        $data['ifsc_code'] = $request->ifsc_code;
        $data['bank_branch'] = $request->bank_branch;
        $data['select_type'] = $request->select_type;
        $data['promote_id'] = $request->promote_id;
        $data['demote_id'] = $request->demote_id;
        $data['introduced_by'] = $request->introduced_by;
        $data['status'] = $request->status;
        $update = User::where('id', $id)->update($data);
        
        
        if(isset($request->select_type))
        {
          
              $get_user = User::where('id',$id)->first();
                   if(isset($get_user))
                    {
                     $changed_id = $get_user->designation_id;
                         if(isset($request->promote_id))
                        {
                            $changed_id = $request->promote_id;
                             if($request->promote_id == 1)
                            {
                                    $user_type = "director";
                                    $count = User::where('user_type','director')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "DIR-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "DIR-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "DIR-0".$ref_count;  
                                        }else{
                                           $ref_no = "DIR-".$ref_count;   
                                        }
                                        
                                    } 
                            }
                            else if($request->promote_id == 2)
                            {
                                    $user_type = "marketing-manager";
                                    $count = User::where('user_type', 'marketing-manager')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "MM-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "MM-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "MM-0".$ref_count;  
                                        }else{
                                           $ref_no = "MM-".$ref_count;   
                                        }
                                        
                                    }     
                            }else if($request->promote_id == 3)
                           {
                                    $user_type = "marketing-supervisor";
                                    $count = User::where('user_type', 'marketing-supervisor')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "MS-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "MS-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "MS-0".$ref_count;  
                                        }else{
                                           $ref_no = "MS-".$ref_count;   
                                        }
                                        
                                    }    
                                }else if($request->promote_id == 4)
                                 {
                                     $user_type = "marketing_executive";
                                    $count = User::where('user_type','marketing_executive')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "ME-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "ME-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "ME-0".$ref_count;  
                                        }else{
                                           $ref_no = "ME-".$ref_count;   
                                        }
                                        
                                    }    
                  } 
                  
             }
             
                     if(isset($request->demote_id))
                        {
                            
                            $changed_id = $request->demote_id;
                           if($request->demote_id == 1)
                            {
                                    $user_type = "director";
                                    $count = User::where('user_type','director')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "DIR-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "DIR-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "DIR-0".$ref_count;  
                                        }else{
                                           $ref_no = "DIR-".$ref_count;   
                                        }
                                        
                                    } 
                            }
                            else if($request->demote_id == 2)
                            {
                                    $user_type = "marketing-manager";
                                    $count = User::where('user_type', 'marketing-manager')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "MM-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "MM-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "MM-0".$ref_count;  
                                        }else{
                                           $ref_no = "MM-".$ref_count;   
                                        }
                                        
                                    }     
                            }else if($request->demote_id == 3)
                           {
                                    $user_type = "marketing-supervisor";
                                    $count = User::where('user_type', 'marketing-supervisor')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "MS-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "MS-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "MS-0".$ref_count;  
                                        }else{
                                           $ref_no = "MS-".$ref_count;   
                                        }
                                        
                                    }    
                                }else if($request->demote_id == 4)
                                 {
                                     $user_type = "marketing_executive";
                                    $count = User::where('user_type','marketing_executive')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "ME-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "ME-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "ME-0".$ref_count;  
                                        }else{
                                           $ref_no = "ME-".$ref_count;   
                                        }
                                        
                                    }    
                              }
                                  
                           }
                           
                           
                            $team_name = '';
             if($get_user->user_type != 'director')
             {
             $get_director_details  = User::where('id',$get_user->director_id)->first();
             if(isset($get_director_details))
              {
             $team_name = $get_director_details->team_name;
              }   
             }else{
               $team_name =   $get_user->team_name;
             }
             
             
        $check_user_count_1 = User::where('designation_id','!=',$changed_id)->where('mobile_no',$get_user->mobile_no)
                            ->where('status',1)
                            ->get()->count();
                            
        if($check_user_count_1 != 0)
        {
            $update_user = User::where('designation_id','!=',$changed_id)->where('mobile_no',$get_user->mobile_no)
                         ->where('status',1)->update(['status' => 0]); 
        }
        
        
        $check_user_count   = User::where('designation_id',$changed_id)->where('mobile_no',$get_user->mobile_no)
                            ->get()->count();
                            
                            
             if($check_user_count == 0)
        {
          $user = new User();
       
        $user->reference_code = $ref_no;
        $user->director_id = $get_user->director_id;
        $user->name = $get_user->name;
        $user->password = $get_user->password;
        $user->encrypt_password = $get_user->encrypt_password;;
        $user->user_type = $user_type;
        $user->team_name = $team_name;
        $user->designation_id = $changed_id;
        $user->father_husband_name = $get_user->father_husband_name;
        $user->branch_id = $get_user->branch_id;
        $user->join_date = $get_user->join_date;
        $user->marrital_status = $get_user->marrital_status;
        $user->email = $get_user->email;
        $user->wedding_date = $get_user->wedding_date;
        $user->nominee_name = $get_user->nominee_name;
        $user->relationship = $get_user->relationship;
        $user->nominee_mobile = $get_user->nominee_mobile;
        $user->address = $get_user->address;
        $user->mobile_no = $get_user->mobile_no;
        $user->alternate_mobile = $get_user->alternate_mobile;
        $user->dob = $get_user->dob;
        $user->gender = $get_user->gender;
        $user->pincode = $get_user->pincode;
        $user->area = $get_user->area;
        $user->city_id = $get_user->city_id;
        $user->state_id = $get_user->state_id;
        $user->country_id = $get_user->country_id;
        $user->bank_name = $get_user->bank_name;
        $user->account_no = $get_user->account_no;
        $user->ifsc_code = $get_user->ifsc_code;
        $user->bank_branch = $get_user->bank_branch;
        $user->introduced_by = $get_user->introduced_by;
        $user->introducer_id = $get_user->introducer;
        $user->thired_party_name = $get_user->thired_party_name;
        $user->thired_party_mobile = $get_user->thired_party_mobile;
        $user->status = 1;
        $insert =  $user->save();  
        }else{
            
        $update_user = User::where('designation_id',$changed_id)->where('mobile_no',$get_user->mobile_no)
                       ->update(['status' => 1]);
               
        }
        
         if(isset($changed_id))
        {
       $user_det   = User::where('designation_id',$changed_id)->where('mobile_no',$get_user->mobile_no)
                            ->first();
                            
                            
        
        if(isset($user_det))
        {
            
            $message = "Dear $user_det->name, your new Marketer ID no. $user_det->reference_code - Ayngaran Housing and Properties.";     
        
        $encode_message = urlencode($message);
        
        $get_director_detail = User::where('id',$user_det->director_id)->where('status',1)->first();
      
      if($get_director_detail)
        {
            
            $director_mobile = $get_director_detail->mobile_no;
            
            $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$director_mobile.'&templateid=1707171205956496536&sms='.$encode_message.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=sgrigscfpotkhv5id4g745nr0rrm4rkm'
   ),
  ));

$response = curl_exec($curl);

curl_close($curl);
  }
        
// SMS Sending for Admin and MD
        
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9842767231%2C9655598888&templateid=1707171205956496536&sms='.$encode_message.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=sgrigscfpotkhv5id4g745nr0rrm4rkm'
  ),
  ));

$response = curl_exec($curl);

curl_close($curl);

          $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$user_det->mobile_no.'&templateid=1707171205956496536&sms='.$encode_message.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=o42l0r4lffqsldjl84o0h06rho94nbgd'
  ),
));

     $response = curl_exec($curl);

     curl_close($curl);   
       
        }
         
        }
           
        }
          
        }
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Staff Updated Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Staff Updated Failed!']);
        }
    }
    public function delete($id)
    {
        if (!empty($id)) {
            $staff = User::where('user_type', 'staff')->where('id', $id)->delete();
            if ($staff) {
                return response()->json(['status' => true, 'message' => 'Staff Deleted Success!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Staff Manager Deleted Failed!']);
            }
        }
    }
}
