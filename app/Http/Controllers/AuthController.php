<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;

class AuthController extends Controller
{
   
   private $apiToken;

   public function __construct(){
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
   }


   public function login(Request $req){
        $data = $req->only("email","password");
        if(Auth::attempt($data)){
            $data['token'] = $this->apiToken;
            $data['name'] = Auth::user()->name;
            $data['msg'] = "login successfully done";
            $data['status'] = true;
            return response()->json($data, 200);
        }
        else{
            return response()->json(["status"=>false,"msg"=> "email and password is incorrect"]);
        }
   }
   public function register(Request $req){
        $req->validate([
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $req->name;
        $user->contact = $req->contact;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);

        $user->save();

        return response()->json([
            'status'=>'success',
            'data' => $user
        ]);
   }
}
