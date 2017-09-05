<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{

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
        if (!$ad->save()) return Response(['error' => 500001], 500);
        $ad_id = $ad->id;
        return Ad::find($ad_id);
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
        $ad->brand_link = $request->brand_link;
        $ad->brand_title1 = $request->brand_title1;
        $ad->brand_description1 = $request->brand_description1;
        $ad->brand_title2 = $request->brand_title2;
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
        return Ad::destroy($id);
    }
}
