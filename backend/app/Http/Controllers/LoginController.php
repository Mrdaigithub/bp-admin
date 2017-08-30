<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use JWTAuth, JWTException;
use App\Models\Users;

class LoginController extends Controller
{
    /**
     * login and get a token string
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {
        if (Validator::make($request->all(), ['username' => 'required'])->fails()) return Response(['error' => 400000], 400);
        if (Validator::make($request->all(), ['password' => 'required'])->fails()) return Response(['error' => 400001], 400);
        if (Validator::make($request->all(), ['username' => 'string'])->fails()) return Response(['error' => 400002], 400);
        if (Validator::make($request->all(), ['password' => 'string'])->fails()) return Response(['error' => 400003], 400);
        if (Validator::make($request->all(), ['username' => 'exists:users,username'])->fails()) return Response(['error' => 400004], 400);

        $user = Users::where('username', $request->username)->first();
        try {
            if ($request->password !== $user->password) return Response(['error' => 401000], 401);
            if (strtotime($user->expired_date) <= time()) return Response(['error' => 401001], 401);
        } catch (JWTException $e) {
            return Response(['error' => 500000], 500);
        }
        return ['token' => JWTAuth::fromUser($user)];
    }

    /**
     * logout remove token
     *
     * @return array
     */
    public function logout()
    {
        return ['logout' => 1];
    }
}
