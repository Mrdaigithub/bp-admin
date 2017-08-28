<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller {

	/**
	 * Get all ad
	 *
	 * @return Response
	 */
	public function index()
	{
		return Ad::all();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update()
	{
		return 'ad update';
	}
}
