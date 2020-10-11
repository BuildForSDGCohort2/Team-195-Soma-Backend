<?php

namespace App\Http\Controllers\API;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


  public function __construct()
  {
      
      $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }
    public function login(Request $request){
 
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
     
        if( auth()->attempt($credentials) ){
          $user = Auth::user();
          $success['token'] =  $user->createToken('AppName')->accessToken;
          return $this->genUserToken($success['token'],$user);
        } else {
    return response()->json(['error'=>'Unauthorised'], 401);
        }
      }
        
      public function register(Request $request)
      {
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required',
          'password_confirmation' => 'required|same:password',
        ]);
     
        if ($validator->fails()) {
          return response()->json([ 'error'=> $validator->errors() ]);
        }
    $data = $request->all();
    $data['password'] = Hash::make($data['password']);
    $user = User::create($data);
    $success['token'] =  $user->createToken('AppName')->accessToken;
    return $this->genUserToken($success['token'],$user);
     
      }

      protected function genUserToken($token,$user=null)
    {        $luser=$user!=null?$user:auth()->user();
        return response()->json([
            'user'=>$luser,
            'access_token' => $token,
            'token_type' => 'bearer',
        ])->header('Authorization', $token);
    }

    public function refresh(){
      $user=auth()->user();
        return $this->genUserToken($user->createToken('AppName')->refreshToken);
    }

      public function logout(Request $request){
        $request->user()->token()->revoke();        
        return response()->json([
          'message' => 'Successfully logged out'
          ]);
        }

      public function user_detail()
      {
    $user = auth()->user();
    return response()->json(['success' => $user], 200);
      }
}
