<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login_form()
    {
        try {

            return view('auth.login');
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function login(Request $request)
    {

        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $is_user = User::where('email',$request->email)->where("status","=",1)->get()->count();
            if($is_user > 0){
                redirect('/index')->with('success', 'Login success!');
                return response()->json(['status' => true, 'message' => 'Login success!'], 200);
            }else{
                return response()->json(['status' => false, 'message' => 'Username and Password does not match.']);
            }
           
        } else {
            return response()->json(['status' => false, 'message' => 'Username and Password does not match.']);
        }
    }

    public function logout()
    {
        $logout = Auth::logout();

        return redirect('/login')->with(['status' => true, 'message' => 'Login Success!']);
    }
}