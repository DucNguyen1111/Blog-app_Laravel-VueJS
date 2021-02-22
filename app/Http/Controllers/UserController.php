<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    // register route
    public function register(Request $request)
    {
        $userId = $request->userId;
        $account = $request->account;
        $password = $request->password;
        $userName = $request->userName;
        $age = (int)$request->age;
        $address = $request->address;
        $avt = '';
        if ($request->hasFile('avatar')) {
            //upload image
            $uploadedFileUrl = Cloudinary::upload($request->file('avatar')->getRealPath())->getSecurePath();
            $avt = $uploadedFileUrl;
        }
        try {
            //insert data into table
            User::insert([
                "userId" => $userId,
                "account" => $account,
                "password" => bcrypt($password),
                "username" => $userName,
                "age" => $age,
                "address" => $address,
                "avt" => $avt,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response()->json([
                "message" => 'insert successfully!'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "message" => 'insert fail'
            ], 404);
        }
    }

    // login route
    public function login(Request $request)
    {
        $credentials = $request->only('account', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userToken = Crypt::encryptString($user["userid"]);
            return response()->json([
                "user_token" => $userToken,
                "user" => [
                    "userId" => $user->userid,
                    "userName" => $user->username,
                    "avt" => $user->avt,
                    "age" => $user->age,
                    "address" => $user->address
                ]
            ], 200)->header("user_token", $userToken);
        } else {
            return response([
                "message" => "login fail"
            ], 401);
        }
    }
    // logout route
    public function getOwner(Request $request)
    {
        try {

            $user = User::where('userid', $request->userId)->get()->makeHidden(['password'])[0];
            return response([
                "user" => $user,
                "status" => 200
            ], 200);
        } catch (\Throwable $th) {
            return response([
                "message" => "Not allow to access",
                "status" => 401
            ]);
        }
    }
}
