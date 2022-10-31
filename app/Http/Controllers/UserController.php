<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //

    public function login(Request $request){

        $check_user_login = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

       // dd($check_user_login);

        if(Auth::attempt($check_user_login)){
            $success = true;
            $message = "ເຂົ້າສູ່ລະບົບ ສຳເລັດ";
        } else {
            $success = false;
            $message = "ອີເມວລ໌ ຫລື ລະຫັດຜ່ານບໍ່ຖຶກຕ້ອງ!";
        }

        $response = [
            "success" => $success,
            "message" => $message
        ];

        return response()->json($response);

    }

    public function logout(){
       
        try {

            Session::flush();
            $success = true;
            $message = "ອອກຈາກລະບົບ ສຳເລັດ!";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            "success" => $success,
            "message" => $message
        ];

        return response()->json($response);
    }

    public function register(Request $request){
        try {
            
            $emailCheck = User::where('email',$request->email);
            
            if($emailCheck->count()){
                
                $success = false;
                $message = "ອີເມວລ໌ນີ້ໄດ້ເຄີຍລົງທະບຽນແລ້ວ!";
            } else {

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = hash::make($request->password);
                $user->save();
                
                $success = true;
                $message = "ລົງທະບຽນ ສຳເລັດ";
            }

            

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            "success" => $success,
            "message" => $message
        ];

        return response()->json($response);
    }
}
