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
        if (Validator::make($request->all(), ['username' => 'required'])->fails()) return Response(['error_code' => 400000], 400);
        if (Validator::make($request->all(), ['password' => 'required'])->fails()) return Response(['error_code' => 400001], 400);
        if (Validator::make($request->all(), ['username' => 'string'])->fails()) return Response(['error_code' => 400002], 400);
        if (Validator::make($request->all(), ['password' => 'string'])->fails()) return Response(['error_code' => 400003], 400);
        if (Validator::make($request->all(), ['username' => 'exists:users,username'])->fails()) return Response(['error_code' => 400004], 400);

        $user = Users::where('username', $request->username)->first();
        try {
            if ($request->password !== $user->password) return Response(['error_code' => 401000], 401);
            if (strtotime($user->expired_date) <= time()) return Response(['error_code' => 401001], 401);
        } catch (JWTException $e) {
            return Response(['error_code' => 500000], 500);
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

    /**
     * create a new user
     *
     * @param Request $request
     * @return Users|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create_user(Request $request)
    {
        if (Validator::make($request->all(), ['username' => 'required'])->fails()) return Response(['error_code' => 400000], 400);
        if (Validator::make($request->all(), ['password' => 'required'])->fails()) return Response(['error_code' => 400001], 400);
        if (Validator::make($request->all(), ['username' => 'string'])->fails()) return Response(['error_code' => 400002], 400);
        if (Validator::make($request->all(), ['password' => 'string'])->fails()) return Response(['error_code' => 400003], 400);
        if (Validator::make($request->all(), ['username' => 'unique:users'])->fails()) return Response(['error_code' => 400005], 400);

        $user = new Users();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->expired_date = date('Y-m-d H:i:s', time() + 2592000);
        if (!$user->save()) return Response(['error_code' => 500001], 500);
        return $user;
    }

    /**
     * update user password
     *
     * @param $uid
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Support\Collection|null|\Symfony\Component\HttpFoundation\Response|static
     */
    public function update_password($uid, Request $request)
    {
        $user = Users::find($uid);

        if (Validator::make($request->all(), ['password' => 'required'])->fails()) return Response(['error_code' => 400001], 400);
        if (Validator::make($request->all(), ['new_password' => 'required'])->fails()) return Response(['error_code' => 400006], 400);
        if (Validator::make($request->all(), ['password' => 'string'])->fails()) return Response(['error_code' => 400003], 400);
        if (Validator::make($request->all(), ['new_password' => 'string'])->fails()) return Response(['error_code' => 400007], 400);
        if ($request->password !== $user->password) return Response(['error_code' => 401000], 401);

        $user->password = $request->new_password;
        if (!$user->save()) return Response(['error_code' => 500001], 500);
        return $user;
    }
}
