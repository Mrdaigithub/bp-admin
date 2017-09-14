<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth, JWTException;
use App\Models\Log;

class DashboardController extends Controller
{

    function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function showYesterday()
    {
        $start_time = date('Y-m-d', strtotime('-1 days')) . " 00:00:00";
        $end_time = date('Y-m-d', strtotime('-1 days')) . " 23:59:59";

        return [
            'baidu' => Log::where('channel', 'baidu')->whereBetween('created_at', [$start_time, $end_time])->count(),
            'sougou' => Log::where('channel', 'sougou')->whereBetween('created_at', [$start_time, $end_time])->count(),
            '360' => Log::where('channel', '360')->whereBetween('created_at', [$start_time, $end_time])->count(),
            'sm' => Log::where('channel', 'sm')->whereBetween('created_at', [$start_time, $end_time])->count()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function showMonth()
    {
        return date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
        $start_time = date('Y-m', strtotime('-1 month')) . "-01 00:00:00";
        $end_time = date('Y-m', strtotime('-1 month')) . "-31 23:59:59";

        $log_baidu = $this->user->log()->where('channel', 'baidu');
        $log_sougou = $this->user->log()->where('channel', 'sougou');
        $log_360 = $this->user->log()->where('channel', '360');
        $log_sm = $this->user->log()->where('channel', 'sm');

        return [
            'baidu' => $log_baidu->whereBetween('created_at', [$start_time, $end_time])->count(),
            'sougou' => $log_sougou->whereBetween('created_at', [$start_time, $end_time])->count(),
            '360' => $log_360->whereBetween('created_at', [$start_time, $end_time])->count(),
            'sm' => $log_sm->whereBetween('created_at', [$start_time, $end_time])->count()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
