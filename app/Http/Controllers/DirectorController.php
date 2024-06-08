<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Director;
use App\Models\Bank;
use App\Models\Relationship;
use App\Models\Pincode;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DirectorController extends Controller
{
    public function index()
    {
        try {
            $directors = User::where('user_type','director')->orderByRaw('LENGTH(reference_code)', 'asc')->get();
            return view('team_manage.directors.index', compact('directors'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {
        try {
             
            $count = User::where('user_type','director')->get()->count();
            $branch = Branch::where('status',1)->get();
            $relations = Relationship::where('status',1)->get();
            $designation = Designation::where('status',1)->get();
            $banks = Bank::where('status',1)->get();
            return view('team_manage.directors.add', compact('count','branch','relations','designation','banks'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'reference_code' => 'required',
            'name' => 'required',
            'password' => 'required',
            'designation_id' => 'required',
            'team_name'  => 'required',
            'father_husband_name' => 'required',
            'branch_id' => 'required',
            'join_date' => 'required',
            // 'introduced_by' => 'required',
            'marrital_status' => 'required',
            // 'wedding_date' => 'required',
            'nominee_name' => 'required',
            'relationship' => 'required',
            'nominee_mobile' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'mobile_no' => 'required|numeric|digits:10',
            'address' => 'required',
            'dob' => 'required',
        ]);
        
        $director = new User();
        
        if($request->password)
        {
            $password = Hash::make($request->password);
            $encrypt_password = encrypt($request->password);
        }
        
        //  if($request->introduced_by == 'thired_party')
        // {
        //     $validate = $request->validate([
        //     'thired_party_name' => 'required',
        //     'thired_party_mobile' => 'required|numeric|digits:10',
           
        // ]);
        // }else{
        //   $validate = $request->validate([
        //     'introducer' => 'required',
            
        // ]);  
        // }
        //   $check_mail = User::where('email',$request->email)->get()->count();
        // if($check_mail > 0)
        // {
        //   return response()->json(['status' => false, 'message' => 'Email Already Exist!']); 
        // }
        
         $check_mobile = User::where('mobile_no',$request->mobile_no)->get()->count();
         
        if($check_mobile > 0)
        {
           return response()->json(['status' => false, 'message' => 'Mobile No Already Exist!']); 
        }
        
       
        
        $director->reference_code = $request->reference_code;
        $director->name = $request->name;
        $director->password = $password;
        $director->encrypt_password = $encrypt_password;
        $director->user_type = 'director';
        $director->designation_id = $request->designation_id;
        $director->team_name = $request->team_name;
        $director->father_husband_name = $request->father_husband_name;
        $director->branch_id = $request->branch_id;
        $director->join_date = $request->join_date;
        $director->marrital_status = $request->marrital_status;
        $director->email = $request->email;
        $director->wedding_date = $request->wedding_date;
        $director->nominee_name = $request->nominee_name;
        $director->nominee_mobile = $request->nominee_mobile;
        $director->address = $request->address;
        $director->mobile_no = $request->mobile_no;
        $director->alternate_mobile = $request->alternate_mobile;
        $director->dob = $request->dob;
        $director->gender = $request->gender;
        $director->pincode = $request->pincode;
        $director->area = $request->area;
        $director->city_id = $request->city_id;
        $director->state_id = $request->state_id;
        $director->country_id = $request->country_id;
        $director->relationship = $request->relationship;
        $director->bank_name = $request->bank_name;
        $director->account_no = $request->account_no;
        $director->ifsc_code = $request->ifsc_code;
        $director->bank_branch = $request->bank_branch;
        $director->introduced_by = $request->introduced_by;
        $director->introducer_id = $request->introducer;
        $director->thired_party_name = $request->thired_party_name;
        $director->thired_party_mobile = $request->thired_party_mobile;
        $director->status = $request->status;
       
        $insert =  $director->save();
        
        
        $message = "Welcome $request->name to join in AYNGARAN FAMILY. Team : $request->team_name, Your ID no.: $request->reference_code - Ayngaran Housing and Properties."; 
        
        $encode_message = urlencode($message);
        
        // SMS Sending for Admin and MD
        
   $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9842767231%2C9655598888&templateid=1707171085093935433&sms='.$encode_message.'',
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
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$request->mobile_no.'&templateid=1707171085093935433&sms='.$encode_message.'',
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

        
        if($insert)
        {
         return response()->json(['status' => true, 'message' => 'Director Created Successfully!']);   
        }
        else{
         return response()->json(['status' => false, 'message' => 'Director Creation Failed!']);
        }
        
    }
    
    public function introducer_list($id)
    {
        $director =User::where('designation_id',$id)->select('id','name')->get();
        return response()->json(['status' => true, 'data' => $director], 200);
    }
    
     public function introducerid_list($id)
    {
        $director =User::where('id',$id)->select('reference_code')->first();
       
        return response()->json(['status' => true, 'data' => $director], 200);
    }

    public function edit($id)
    {
        if (!empty($id)) {
            $designation_id = [1,2,3,4];
            $introducer_name = '';
            $introducer_id = '';
            $director =User::where('user_type','director')->where('id', $id)->first();
            if($director->introduced_by != 'thired_party')
            {
              $introducer_name = User::where('designation_id',$director->introduced_by)->get();
              $introducer_id = User::where('id',$director->introducer_id)->value('reference_code');
            }
            $branch = Branch::where('status',1)->get();
            $relations = Relationship::where('status',1)->get();
            $areas  = Pincode::where('pincode', $director->pincode)->get();
            $state  = Pincode::select('id', 'state')->where('pincode', $director->pincode)->first();
            $city  = Pincode::select('id', 'city')->where('pincode', $director->pincode)->first();
            $designation = Designation::where('status',1)->get();
            $banks = Bank::where('status',1)->get();
 
            return view('team_manage.directors.edit', compact('director', 'areas', 'state', 'city','branch','relations','designation','introducer_id','introducer_name','banks'));
        }
        return response()->json(['status' => false, 'message' => 'Director not found!']);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'reference_code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',    //change by Gowtham.S
            'designation_id' => 'required',
            'team_name'  => 'required',
            'father_husband_name' => 'required',
            'branch_id' => 'required',
            'join_date' => 'required',
            // 'introduced_by' => 'required',
            'marrital_status' => 'required',
            // 'wedding_date' => 'required',
            'nominee_name' => 'required',
            'relationship' => 'required',
            'nominee_mobile' => 'required|numeric|digits:10',
            'mobile_no' => 'required|numeric|digits:10',
            'address' => 'required',
            'dob' => 'required',
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
        if($request->password)
        {
            $password = Hash::make($request->password);
            $encrypt_password = encrypt($request->password);
        }
        if($request->introduced_by == 'thired_party')
        {
        
            $data['introducer_id'] = 0;
            $data['thired_party_name'] = $request->thired_party_name;
            $data['thired_party_mobile'] = $request->thired_party_mobile;
        }else{
 
        
        if($request->introduced_by != '')
        {
            $data['introducer_id'] = $request->introducer;
        }else{
            
            $data['introducer_id'] = 0;
        }
            $data['thired_party_name'] = null;
            $data['thired_party_mobile'] = null;
        }
        
        
        //  $check_mobile = User::where('mobile_no',$request->mobile_no)->where('status',1)->where('id','!=',$id)->get()->count();
         
        // if($check_mobile > 0)
        // {
        //   return response()->json(['status' => false, 'message' => 'Mobile No Already Exist!']); 
        // }
        
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
        
        $data['reference_code'] = $request->reference_code;
        $data['name'] = $request->name;
        $data['password'] = $password;
        $data['encrypt_password'] = $encrypt_password;
        // $data['user_type'] = 'director';
        $data['designation_id'] = $request->designation_id;
        $data['team_name'] = $request->team_name;
        $data['father_husband_name'] = $request->father_husband_name;
        $data['branch_id'] = $request->branch_id;
        $data['join_date'] = $request->join_date;
        $data['marrital_status'] = $request->marrital_status;
        $data['email'] = $request->email;
        $data['wedding_date'] = $request->wedding_date;
        $data['nominee_name'] = $request->nominee_name;
        $data['nominee_mobile'] = $request->nominee_mobile;
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
        $data['introduced_by'] = $request->introduced_by;
        $data['select_type'] = $request->select_type;
        $data['promote_id'] = $request->promote_id;
        $data['demote_id'] = $request->demote_id;
        $data['status'] = $status;
        $data['relationship'] = $request->relationship;
         
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
                             if($request->promote_id == 2)
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
                  }else if($request->promote_id == 5)
                                 {
                                     $user_type = "staff";
                                    $count = User::where('user_type','staff')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "ST-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "ST-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "ST-0".$ref_count;  
                                        }else{
                                           $ref_no = "ST-".$ref_count;   
                                        }
                                        
                                    } 
                  }
                                  
             }
             
                     if(isset($request->demote_id))
                        {
                            
                            $changed_id = $request->demote_id;
                            if($request->demote_id == 2)
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
                      }else if($request->demote_id == 5)
                                 {
                                     $user_type = "staff";
                                    $count = User::where('user_type','staff')->get()->count();
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "ST-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "ST-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "ST-0".$ref_count;  
                                        }else{
                                           $ref_no = "ST-".$ref_count;   
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
        
        if($update)
        {
        return response()->json(['status' => true, 'message' => 'Director Updated Successfully!']);    
        }else{
         return response()->json(['status' => false, 'message' => 'Director Updation Failed!']);
        }
        
    }
    public function delete($id)
    {
        if (!empty($id)) {
            $director = User::where('id', $id)->delete();
            if($director)
            {
              return response()->json(['status' => true, 'message' => 'Director Deleted Successfully!']);  
            }else{
              return response()->json(['status' => false, 'message' => 'Director Deleted Failed!']);
            }
            
        }
    }
}
