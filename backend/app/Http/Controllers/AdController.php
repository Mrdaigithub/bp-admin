<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth, JWTException;
use App\Models\Ad;

class AdController extends Controller
{
    function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Get all ad
     *
     * @return Response
     */
    public function index()
    {
        return $this->user->ad()->orderBy('id', 'asc')->get();
    }

    /**
     * Get all ad
     *
     * @return Response
     */
    public function add()
    {
        $ad = new Ad();
        if (!$ad->save()) return Response(['error' => 500001], 500);
        $this->user->ad()->attach($ad->id);
        return Ad::find($ad->id);
    }

    /**
     * Update ad
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id, Request $request)
    {
        if (!$ad = Ad::find($id)) return 'false';
        $ad->type = $request->type;
        $ad->title = $request->title;
        $ad->description = $request->description;
        $ad->picture = $request->picture;
        $ad->link = $request->link;
        $ad->show_link = $request->show_link;
        $ad->brand_description1 = $request->brand_description1;
        $ad->brand_description2 = $request->brand_description2;
        $ad->doctor_name = $request->doctor_name;
        $ad->doctor_job = $request->doctor_job;

        if (!$ad->save()) return Response(['error' => 500001], 500);
        return $ad;
    }

    /**
     * Remove ad by id
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->user->ad()->detach($id);
        return Ad::destroy($id);
    }
}
