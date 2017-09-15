<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth, JWTException;
use Validator;
use App\Models\Users;
use App\Models\Log;

class LogController extends Controller
{

    /**
     * Display a listing of the logs.
     *
     * @return mixed
     */
    public function index()
    {
        $page_size = 20;
        $user = JWTAuth::parseToken()->authenticate();
        $res = $user->log()->orderBy('created_at', 'desc')->paginate($page_size);
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $uid
     * @param Request $request
     * @return Log|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create($uid, Request $request)
    {
        if (Validator::make($request->all(), ['keyword' => 'string'])->fails()) return Response(['error' => 400014], 400);
        if (Validator::make($request->all(), ['channel' => 'string'])->fails()) return Response(['error' => 400014], 400);

        $user = Users::where('uid', $uid)->first();
        $log = new Log();
        if ($request->has('keyword')) $log->keyword = $request->keyword;
        if ($request->has('channel')) $log->channel = $request->channel;
        if ($request->has('sourceurl')) $log->sourceurl = $request->sourceurl;
        $log->ip = $_SERVER['REMOTE_ADDR'];
        if (!$log->save()) return Response(['error' => 500001], 500);
        $user->log()->attach($log->id);
        return $log;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->log()->detach($id);
        return Log::destroy($id);
    }

}
