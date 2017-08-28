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
     * Get all ad
     *
     * @return Response
     */
    public function add()
    {
        $ad = new Ad();
        if (!$ad->save()) return Response(['error_code' => 500001], 500);
        $ad_id = $ad->id;
        return Ad::find($ad_id);
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

    /**
     * Remove ad by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return Ad::destroy($id);
    }
}
