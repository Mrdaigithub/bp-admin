<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use JWTAuth, JWTException;
use App\Models\Users;

class UserController extends Controller
{
    /**
     * Get users list
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Users::all();
    }

    /**
     * create a new user
     *
     * @param Request $request
     * @return Users|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create_user(Request $request)
    {
        if (!JWTAuth::parseToken()->authenticate()->power) return Response(['error' => 403000], 403);
        if (Validator::make($request->all(), ['username' => 'required'])->fails()) return Response(['error' => 400000], 400);
        if (Validator::make($request->all(), ['password' => 'required'])->fails()) return Response(['error' => 400001], 400);
        if (Validator::make($request->all(), ['username' => 'string'])->fails()) return Response(['error' => 400002], 400);
        if (Validator::make($request->all(), ['password' => 'string'])->fails()) return Response(['error' => 400003], 400);
        if (Validator::make($request->all(), ['username' => 'unique:users'])->fails()) return Response(['error' => 400005], 400);
        if (Validator::make($request->all(), ['username' => 'min:4'])->fails()) return Response(['error' => 400008], 400);
        if (Validator::make($request->all(), ['username' => 'max:10'])->fails()) return Response(['error' => 400009], 400);
        if (Validator::make($request->all(), ['password' => 'min:4'])->fails()) return Response(['error' => 400010], 400);
        if (Validator::make($request->all(), ['password' => 'max:16'])->fails()) return Response(['error' => 400011], 400);

        $user = new Users();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->expired_date = $request->has('expired_date') ? $request->expired_date : date('Y-m-d H:i:s', time() + 2592000);
        if (!$user->save()) return Response(['error' => 500001], 500);
        return $user;
    }

    /**
     * Get user info by id
     *
     * @param $uid
     * @return \Illuminate\Support\Collection|null|static
     */
    public function show($uid)
    {
        if ($uid == 0) return JWTAuth::parseToken()->authenticate();
        if (Validator::make(['id' => $uid], ['id' => 'exists:users'])->fails()) return Response(['error' => 400004], 400);
        return Users::find($uid);
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

        if (Validator::make($request->all(), ['password' => 'required'])->fails()) return Response(['error' => 400001], 400);
        if (Validator::make($request->all(), ['new_password' => 'required'])->fails()) return Response(['error' => 400006], 400);
        if (Validator::make($request->all(), ['password' => 'string'])->fails()) return Response(['error' => 400003], 400);
        if (Validator::make($request->all(), ['new_password' => 'string'])->fails()) return Response(['error' => 400007], 400);
        if (Validator::make($request->all(), ['new_password' => 'min:4'])->fails()) return Response(['error' => 400010], 400);
        if (Validator::make($request->all(), ['new_password' => 'max:16'])->fails()) return Response(['error' => 400011], 400);
        if ($request->password !== $user->password) return Response(['error' => 401000], 401);

        $user->password = $request->new_password;
        if (!$user->save()) return Response(['error' => 500001], 500);
        return $user;
    }

    /**
     * update user expired
     *
     * @param $uid
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Support\Collection|null|\Symfony\Component\HttpFoundation\Response|static
     */
    public function update_expired($uid, Request $request)
    {
        if (!JWTAuth::parseToken()->authenticate()->power) return Response(['error' => 403000], 403);
        if (Validator::make(['id' => $uid], ['id' => 'exists:users'])->fails()) return Response(['error' => 400004], 400);
        if (Validator::make($request->all(), ['expired_date' => 'required'])->fails()) return Response(['error' => 400012], 400);
        if (Validator::make($request->all(), ['expired_date' => 'string'])->fails()) return Response(['error' => 400013], 400);

        $user = Users::find($uid);
        $user->expired_date = $request->expired_date;
        if (!$user->save()) return Response(['error' => 500001], 500);
        return $user;
    }
}
