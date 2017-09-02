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
        $configs = Config::first();
        if (!$configs) {
            $configs = new Config();
            if (!$configs->save()) return Response(['error' => 500001], 500);
            $configs = Config::find($configs->id);
        }
        foreach ($request->all() as $key => $val) {
            $configs->$key = $val;
        }
        if (!$configs->save()) return Response(['error' => 500001], 500);
        return $configs;
    }
}
