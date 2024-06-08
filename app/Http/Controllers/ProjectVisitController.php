<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Designation;
use App\Models\Director;
use App\Models\MarketingExecutive;
use App\Models\MarketingManager;
use App\Models\MarketingSupervisor;
use App\Models\Pincode;
use App\Models\Booking;
use App\Models\Account;
use App\Models\ProjectVisit;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\ProjectDetail;
use App\Models\PlotManagement;
use App\Models\Relationship;
use App\Models\Staff_Detail;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\PrintTemplateContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProjectVisitController extends Controller
{
    public function index()
    {
        // try {
            

            $projects = ProjectVisit::leftjoin('project_details','project_details.id','project_visit.project_id')
                       ->leftjoin('users','users.id','project_visit.marketer_id')  
                       ->select('project_visit.*' ,'project_details.short_name','users.name')->orderby('project_visit.id','asc')->get();
            
            return view('project_visit.index', compact('projects'));
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
    }
    public function create()
    {
        try {
            $count = ProjectVisit::where('id','!=',0)->get()->count();
            $branch = Branch::where('status', 1)->get();
            $customers = Booking::where('mobile','!=',null)->get();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $projects = ProjectDetail::all();
            $banks = Bank::where('status', 1)->get();
            $vehicles = Vehicle::where('status', 1)->get();
            
            $marketer = User::where('user_type', '!=', 'staff')->where('user_type', '!=', 'admin')->where('status',1);
             
            $marketer = $marketer->get();
            
             $team_name = User::where('user_type','!=','staff')->where('user_type','!=','admin')->groupby('team_name')->get();
            
            return view('project_visit.add', compact('count','customers' , 'branch','marketer','team_name', 'relations', 'designation','projects','banks','vehicles'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    
       public function marketer_list($id)
    {
        $data = User::where('team_name',$id)->get();
         
         return response()->json(['status' => true, 'data' => $data ], 200);
    }
   
    
    public function store(Request $request)
    {
         
            
       $request->validate([
            'project_id' => 'required',
            'visit_number' => 'required',
            'visit_date' => 'required',
            'customer_name' => 'required',
            'no_of_person' => 'required',
            'team' => 'required',
            'marketer_id' => 'required',
            'vehicle' => 'required',
            // 'trip_distance' => 'required',
             
        ]);
        $sites = '';
        if($request->project_id != ""){
        $sites = implode(',',$request->project_id);
        }
        $project = new ProjectVisit();
        $project->project_id = $sites;
        $project->visit_number = $request->visit_number;
        $project->visit_date = $request->visit_date;
        $project->customer_name = $request->customer_name;
        $project->no_of_person = $request->no_of_person;
        $project->team_name = $request->team;
        $project->marketer_id = $request->marketer_id;
        $project->vehicle = $request->vehicle;
        $project->distance = $request->trip_distance;
        $project->feedback = $request->feedback;
        $project->created_by = Auth::user()->id;
        $project->created_at = date('Y-m-d H:i:s');
        $project =  $project->save();
        
       
        
        
        
        if ($project) {
            return response()->json(['status' => true, 'message' => 'Project Visit Created Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Project Visit Creation Failed!']);
        }
        
     
    }

    public function edit($id)
    {
        if (!empty($id)) {
            $project = ProjectVisit::where('id',$id)->first();
            $count = ProjectVisit::where('id','!=',0)->get()->count();
            
            $branch = Branch::where('status', 1)->get();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $projects = ProjectDetail::all();
            $vehicles = Vehicle::where('status', 1)->get();
            
            $banks = Bank::where('status', 1)->get();
            $marketer = User::where('user_type', '!=', 'staff')->where('user_type', '!=', 'admin')->where('status',1);
             
            $marketer = $marketer->get();
            
            $team_name = User::where('user_type','!=','staff')->where('user_type','!=','admin')->groupby('team_name')->get();
            $markertes = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('status',1)->get();
            return view('project_visit.edit', compact('count', 'branch', 'relations', 'designation','projects' 
            ,'banks','markertes','marketer','team_name','project','vehicles'));

        
        }
    }
    public function update(Request $request, $id)
    {
        
         $request->validate([
            'project_id' => 'required',
            'visit_number' => 'required',
            'visit_date' => 'required',
            'customer_name' => 'required',
            'no_of_person' => 'required',
            'team' => 'required',
            'marketer_id' => 'required',
            'vehicle' => 'required',
            // 'trip_distance' => 'required',
             
        ]);
        
        $project = [];
        $sites = '';
        if($request->project_id != ""){
        $sites = implode(',',$request->project_id);
        }
        
        if(!empty($sites) && $sites != null){       // Updated by gowtham.s
 
        $project['project_id'] = $sites;
        $project['visit_number'] = $request->visit_number;
        $project['visit_date'] = $request->visit_date;
        $project['customer_name'] = $request->customer_name;
        $project['no_of_person'] = $request->no_of_person;
        $project['team_name'] = $request->team;
        $project['marketer_id'] = $request->marketer_id;
        $project['vehicle'] = $request->vehicle;
        $project['distance'] = $request->trip_distance;
        $project['feedback'] = $request->feedback;
        $project['updated_by'] = Auth::user()->id;
        $project['updated_at'] = date('Y-m-d H:i:s');
        
    
        $update = ProjectVisit::where('id', $id)->update($project);
        
        
            if ($update) {
                return response()->json(['status' => true, 'message' => 'Project Visit Updated Successfully!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Project Visit Updation Failed!']);
            }
        }
         return response()->json(['status' => false, 'message' => 'Project Visit Updation Failed!']);
    }
    
    
    public function delete($id)
    {
        if (!empty($id)) {
            
            $delete = ProjectVisit:: where('id', $id)->delete();
            
            
            if ($delete) {
                return response()->json(['status' => true, 'message' => 'Project Visit Detail Deleted Success!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Project Visit Detail Deleted Failed!']);
            }
        }
    }
    
   
    
}
