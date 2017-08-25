<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Config::all();
	}

    /**
     * Update the specified resource in storage.
     *
     * @return string
     */
	public function update()
	{
		return 'update';
	}
}
