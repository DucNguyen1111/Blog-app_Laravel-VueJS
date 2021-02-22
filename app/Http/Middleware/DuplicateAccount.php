<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class DuplicateAccount
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
        $account = $request->account;
        $users = User::where('account', $account)->get();
        if (count($users)) {
            return response(["message" => "user already exist"], 409);
        }
        return $next($request);
    }
}
