<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use JWTAuth, JWTException;

class DashboardController extends Controller
{

    function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
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
            'baidu' => $this->user->log()->where('channel', 'baidu')->whereBetween('created_at', [$start_time, $end_time])->count(),
            'sogou' => $this->user->log()->where('channel', 'sogou')->whereBetween('created_at', [$start_time, $end_time])->count(),
            '360' => $this->user->log()->where('channel', '360')->whereBetween('created_at', [$start_time, $end_time])->count(),
            'sm' => $this->user->log()->where('channel', 'sm')->whereBetween('created_at', [$start_time, $end_time])->count()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function showMonth()
    {
        $res = [];
        for ($i = 30; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime("-$i day"));
            $start_time = "$day 00:00:00";
            $end_time = "$day 23:59:59";
            $day_log_data = [
                'date' => date('m-d', strtotime($day)),
                '百度' => $this->user->log()->where('channel', 'baidu')->whereBetween('created_at', [$start_time, $end_time])->count(),
                '搜狗' => $this->user->log()->where('channel', 'sogou')->whereBetween('created_at', [$start_time, $end_time])->count(),
                '360' => $this->user->log()->where('channel', '360')->whereBetween('created_at', [$start_time, $end_time])->count(),
                '神马' => $this->user->log()->where('channel', 'sm')->whereBetween('created_at', [$start_time, $end_time])->count()
            ];
            array_push($res, $day_log_data);
        }
        return json_encode($res);
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function showTableData()
    {
        $today = [
            $this->user->log()->where('channel', 'baidu')->whereBetween('created_at', [date('Y-m-d') . " 00:00:00", date('Y-m-d') . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sogou')->whereBetween('created_at', [date('Y-m-d') . " 00:00:00", date('Y-m-d') . " 23:59:59"])->count(),
            $this->user->log()->where('channel', '360')->whereBetween('created_at', [date('Y-m-d') . " 00:00:00", date('Y-m-d') . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sm')->whereBetween('created_at', [date('Y-m-d') . " 00:00:00", date('Y-m-d') . " 23:59:59"])->count(),
        ];
        $yesterday = [
            $this->user->log()->where('channel', 'baidu')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')) . " 00:00:00", date('Y-m-d', strtotime('-1 days')) . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sogou')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')) . " 00:00:00", date('Y-m-d', strtotime('-1 days')) . " 23:59:59"])->count(),
            $this->user->log()->where('channel', '360')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')) . " 00:00:00", date('Y-m-d', strtotime('-1 days')) . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sm')->whereBetween('created_at', [date('Y-m-d', strtotime('-1 days')) . " 00:00:00", date('Y-m-d', strtotime('-1 days')) . " 23:59:59"])->count(),
        ];
        $last_month = [
            $this->user->log()->where('channel', 'baidu')->whereBetween('created_at', [date('Y-m-01', strtotime("-1 month")) . " 00:00:00", date('Y-m-t', strtotime("-1 month")) . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sogou')->whereBetween('created_at', [date('Y-m-01', strtotime("-1 month")) . " 00:00:00", date('Y-m-t', strtotime("-1 month")) . " 23:59:59"])->count(),
            $this->user->log()->where('channel', '360')->whereBetween('created_at', [date('Y-m-01', strtotime("-1 month")) . " 00:00:00", date('Y-m-t', strtotime("-1 month")) . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sm')->whereBetween('created_at', [date('Y-m-01', strtotime("-1 month")) . " 00:00:00", date('Y-m-t', strtotime("-1 month")) . " 23:59:59"])->count()
        ];
        $current_month = [
            $this->user->log()->where('channel', 'baidu')->whereBetween('created_at', [date('Y-m-01') . " 00:00:00", date('Y-m-t') . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sogou')->whereBetween('created_at', [date('Y-m-01') . " 00:00:00", date('Y-m-t') . " 23:59:59"])->count(),
            $this->user->log()->where('channel', '360')->whereBetween('created_at', [date('Y-m-01') . " 00:00:00", date('Y-m-t') . " 23:59:59"])->count(),
            $this->user->log()->where('channel', 'sm')->whereBetween('created_at', [date('Y-m-01') . " 00:00:00", date('Y-m-t') . " 23:59:59"])->count()
        ];
        $mom = [
            $last_month[0] === 0 ? '上月暂无数据' : (($current_month[0] - $last_month[0]) / $last_month[0] * 100) . "%",
            $last_month[1] === 0 ? '上月暂无数据' : (($current_month[1] - $last_month[1]) / $last_month[1] * 100) . "%",
            $last_month[2] === 0 ? '上月暂无数据' : (($current_month[2] - $last_month[2]) / $last_month[2] * 100) . "%",
            $last_month[3] === 0 ? '上月暂无数据' : (($current_month[3] - $last_month[3]) / $last_month[3] * 100) . "%"
        ];
        return [
            'today' => $today,
            'yesterday' => $yesterday,
            'lastMonth' => $last_month,
            'currentMonth' => $current_month,
            'mom' => $mom
        ];
    }
}
