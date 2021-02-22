<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info("something happens");
        try {
            $token = $request->header('user_token');
            $userId = Crypt::decryptString($token);
            $users = User::where('userid', $userId)->get();
            if (count($users)) {
                $request["userId"] = $userId;
                return $next($request);
            } else {
                return response()->json([
                    "message" => "Not allow to access",
                    "status" => 301
                ]);
            }
            return $next($request);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Not allow to access because error",
                "status" => 301
            ]);
        }
    }
}
