<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{

    /**
     * Get all config
     *
     * @return mixed
     */
    public function index()
    {
        return Config::first();
    }

    /**
     * Update config
     *
     * @param Request $request
     * @return string
     */
    public function update(Request $request)
    {
        $config = Config::first();
        foreach ($request->all() as $key => $val) {
            $config->$key = $val;
        }
        if (!$config->save()) return Response(['error' => 500001], 500);
        return $config;
    }
}
