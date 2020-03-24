<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ApiTokenController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
/**
 * @OA\Info(
 *     version="1.0",
 *     title="Video Resource OpenApi",
 *     @OA\Contact(
 *         name="Hou jian dong",
 *         url="http://lzad.cc",
 *         email="houjiandong@lzad.cc"
 *     )
 * )
 * /**
 *  @OA\Server(
 *      url="http://192.168.1.156/api/",
 *      description="DongGe localhost server"
 * )
 */



class PublicController extends Controller
{
    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Projects"},
     *      summary="用户登录",
     *      description="用户登录接口",
     *      @OA\Response(response=200,description="登录成功，返回token"),
     *      @OA\Response(response=401, description="用户验证失败"),
     *      @OA\RequestBody(
     *         request="email",
     *         required=true,
     *         description="登录邮箱",
     *      @OA\Schema(
     *             type="string"
     *         )
     *     ),

     *     )
     *
     * Returns list of projects
     */
    public function login(Request $request){
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $token=ApiTokenController::update($request);
            $u=Auth::user();
            $user['name']=$u['name'];
            $user['email']=$u['email'];
            $user['name']=$u['name'];
            return ['code'=>200,'data'=>['user'=>$user,'token'=>$token['token']]];
        }else
        {
            return ['code'=>401,'msg'=>'用户名密码错误!'];
        }
    }


    public function createUser(Request $request){
        $request->validate([
            'email' => 'bail|required|unique:email|max:255',
            'name' => 'required',
            'password' => 'required',
        ]);
        $data=$request->only('name','email','password');
        $u= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            //'api_token' => Str::random(60),
            'user_type' => 1,
        ]);
        return ['code'=>200,'data'=>$u];
    }

    public function logout(Request $request){
        ApiTokenController::update($request);
        return ['code'=>200,'msg'=>'清除token，退出成功'];
    }

}
