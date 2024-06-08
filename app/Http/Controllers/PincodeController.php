<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PincodeController extends Controller
{
    public function pincode_generate(Request $request, $pincode)
    {
        if (isset($pincode) && $pincode != "") {

            $areas = DB::table('pincodes')->where('pincode', $pincode)->select('id', 'area')->distinct('area')->get();
            $state = DB::table('pincodes')->where('pincode', $pincode)->select('id', 'state')->distinct('state')->first();
            $city = DB::table('pincodes')->where('pincode', $pincode)->select('id', 'city')->distinct('city')->first();
            return response()->json(['status' => true, 'data' => $areas, 'state' => $state, 'city' => $city], 200);
        }
        return response()->json(['status' => false, 'message' => 'Invalid Pincode']);
    }
}