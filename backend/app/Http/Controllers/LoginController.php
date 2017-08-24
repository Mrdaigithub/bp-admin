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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Validator::make($request->all(), ['username' => 'required'])->fails()) return Response(['error_code' => 40100], 401);
        if (Validator::make($request->all(), ['password' => 'required'])->fails()) return Response(['error_code' => 401001], 401);
        if (Validator::make($request->all(), ['username' => 'string'])->fails()) return Response(['error_code' => 401002], 401);
        if (Validator::make($request->all(), ['password' => 'string'])->fails()) return Response(['error_code' => 401003], 401);
        if (Validator::make($request->all(), ['username' => 'exists:users,username'])->fails()) return Response(['error_code' => 401004], 401);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy()
    {
        return 'remove';
    }

}
