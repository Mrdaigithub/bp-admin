<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth, JWTException;
use App\Models\Config;
use App\Models\Users;

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
        $root_config = Users::where('power', 1)->first()->config()->first();
        $config = $this->user->config->first();
        $config->swturl = $root_config->swturl;
        $config->fronturl = $root_config->fronturl;
        $config->previewurl = "<script src='$config->swturl?uid=" . $this->user->uid . "'></script>";
        return $config;
    }

    /**
     * Update config
     *
     * @param Request $request
     * @return string
     */
    public function update(Request $request)
    {
        $args = $request->all();
        $isRoot = !!$this->user->power;
        $configs = $this->user->config->first();
        if (!$configs) {
            $configs = new Config();
            if (!$configs->save()) return Response(['error' => 500001], 500);
            $configs = Config::find($configs->id);
            $this->user->config()->attach($configs->id);
        }
        if (!$isRoot) {
            $root_configs = Users::where('power', 1)->first()->config()->first();
            $args['fronturl'] = '';
            $args['swturl'] = '';
        }
        foreach ($args as $key => $val) {
            $configs->$key = $val;
        }
        if (!$configs->save()) return Response(['error' => 500001], 500);
        return $configs;
    }
}
