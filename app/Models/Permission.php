<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   
    protected $table = 'permissions';
    protected $fillable = ['designation_id', 'page_id','action_name','action_name_1','status'];
    
    public function checkPermission($permission){
        
    $role = Auth()->user()->designation_id;
    $query = $this->select('action_name')->where('designation_id', $role)
    ->where('action_name',$permission)->first();
    if(!empty($query))
    {
        return true;
    }else{
        return false;
    }
}

}