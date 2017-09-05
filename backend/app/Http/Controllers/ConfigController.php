<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth, JWTException;
use App\Models\Config;

class ConfigController extends Controller
{
    function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Get all config
     *
     * @return mixed
     */
    public function index()
    {
        return $this->user->config->first();
    }

    /**
     * Update config
     *
     * @param Request $request
     * @return string
     */
    public function update(Request $request)
    {
        $configs = $this->user->config->first();
        if (!$configs) {
            $configs = new Config();
            if (!$configs->save()) return Response(['error' => 500001], 500);
            $configs = Config::find($configs->id);
            $this->user->config()->attach($configs->id);
        }
        foreach ($request->all() as $key => $val) {
            $configs->$key = $val;
        }
        if (!$configs->save()) return Response(['error' => 500001], 500);
        return $configs;
    }
}
