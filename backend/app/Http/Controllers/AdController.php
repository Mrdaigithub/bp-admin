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
        $ad->adtype = $request->adtype;
        $ad->keyds = $request->keyds;
        $ad->nokeyds = $request->nokeyds;
        $ad->title = $request->title;
        $ad->depict = $request->depict;
        $ad->link = $request->link;
        $ad->xslink = $request->xslink;
        $ad->bshow = $request->bshow;
        $ad->brandlogo = $request->brandlogo;
        $ad->brand_title1 = $request->brand_title1;
        $ad->brand_lnke1 = $request->brand_lnke1;
        $ad->brand_title2 = $request->brand_title2;
        $ad->brand_lnke2 = $request->brand_lnke2;
        $ad->dtname = $request->dtname;
        $ad->docposition = $request->docposition;
        $ad->dtpic = $request->dtpic;

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
