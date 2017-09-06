<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class WallpaperController extends Controller
{

    /**
     * get bing wallpaper url
     *
     * @return Response
     */
    public function index()
    {
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = json_decode(curl_exec($curl));
        curl_close($curl);
        return "https://www.bing.com/" . $data->images[0]->url;
    }
}
