<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use JWTAuth, JWTException;
use App\Models\Users;

class UserController extends Controller
{
    /**
     * Get user info
     *
     * @param $uid
     * @return \Illuminate\Support\Collection|null|static
     */
    public function show($uid)
    {
        if ($uid == 0) return JWTAuth::parseToken()->authenticate();
        return Users::find($uid);
    }
}
