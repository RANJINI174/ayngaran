<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Permission;
use App\Models\UserType;
use App\Models\Designation;
use DB;

class PermissionController extends Controller
{
    public function index()
    {
        
        
         try {
            $user_details = Permission::leftjoin('designation as u','u.id','permissions.designation_id')
            ->select('u.designation','u.id as designation_id')->distinct()->get();
            
              return view('permissions.index', compact('user_details'));
             
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
        
       
    }
    
    public function create()
    {
        try {
            $user_type = UserType::orderBy('id', 'asc')->get();
            
            $parent_pages = Pages::where('is_parent',1)->orderBy('id', 'asc')->get();
            
            $sub_pages = Pages::where('is_parent',0)->orderBy('id', 'asc')->get();
            
            return view('permissions.add', compact('user_type','parent_pages','sub_pages'));
            
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    

    public function store(Request $request)
    {
        $validator = $request->validate([
            'user_role' => 'required',
       
        ]);
        
       if(isset($request->permissions))
       {
           foreach($request->permissions as $permission)
           {
               
           
            $permission = Permission::create([
                'user_role' => $request->user_role,
                'page_id' => $request->page_id,
                'action_name' => $permission,
                'status' => 1
                ]);
           }
       }
        
        return response()->json(['status' => true, 'message' => 'Permission Added Successfully!'], 200);    
      
        
    }

    public function edit($id)
    {
        //  try {
            $designation = Designation::orderBy('id', 'asc')->get();
            
            $parent_pages = Pages::where('is_parent',1)->orderBy('id', 'asc')->get();
            
            $sub_pages = Pages::where('is_parent',0)->orderBy('id', 'asc')->get();
            
            $permission = DB::table('permissions')->where('designation_id',$id)->get();
             $role_permissions = [];
            foreach ($permission as $role_perm) {
            $role_permissions[] = $role_perm->action_name;
              }
              
           
         
            $designation_id = $id;
            
            return view('permissions.edit', compact('designation','parent_pages','sub_pages','permission','designation_id','role_permissions'));
            
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
    }

    public function update(Request $request, $id)
    {
         $validator = $request->validate([
            'designation_id' => 'required',
       
        ]);
        
        $existig = Permission::where('designation_id',$id)->get();
        $role_permissions = [];
            foreach ($existig as $role_perm) {
            $role_permissions[] = $role_perm->action_name_1;
              }
        
       
        if(isset($request->permissions))
        {
            
       
       
        $not_exist = array_diff($request->permissions,$role_permissions);
        
        $not_in = array_diff($role_permissions,$request->permissions);
      
      
       if(!empty($not_exist))
       {
           foreach($not_exist as $k=>$permission)
           {
               $action_name_1 = $permission;
               $exploe_permi = explode('_',$permission);
               $permission_val = $exploe_permi[0];
               $page_id = $exploe_permi[1];
               
            $create_permision = Permission::create([
                'designation_id' => $request->designation_id,
                'page_id' => $page_id,
                'action_name' => $permission_val,
                'action_name_1' => $permission_val."_".$page_id,
                'status' => 1
                ]);
          }
          
       }
       
       if(!empty($not_in))
       {
         foreach($not_in as $permission)
           {
               $exploe_permi = explode('_',$permission);
               $permission_val = $exploe_permi[0];
               $page_id = $exploe_permi[1];
          $permission = Permission::where('designation_id',$id)->where('page_id',$page_id)
                           ->where('action_name',$permission_val)->delete();
           } 
       }
        }
        return response()->json(['status' => true, 'message' => 'Permission Updated Successfully!'], 200); 
        
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $project = Permission::where('designation_id',$id)->delete();
            
            return response()->json(['status' => 200, 'message' => 'Permission Deleted Successfully!'], 200);
        }
    }
}

 