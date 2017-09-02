<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Ad;

class TemplateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $config = Config::first();
        $htmlStr = "";
        $brands = Ad::where('adtype', 'brand')->get();
        $defaults = Ad::where('adtype', 'default')->get();
        foreach ($brands as $key => $brand) {
            $htmlStr .=
                "<div class='ec_ad_results' sourceid='160' posid='1' prank='1'style='display:block !important;visibility: visible !important;'>
                  <div class='ec_xiaobao'>
                    <a href='http://baozhang.baidu.com/guarantee/?mdevice=mobile'>
                      <i class='ec_font_xiaobao'></i>
                    </a>
                  </div>
                  <div class='c-container ec_resitem ec_wise_pp' style='display:block !important;visibility: visible !important;'>
                    <div class='ec_img_zone'>
                      <a class='ec_title c-blocka' href='$brand->link'>
                        <h3 class='c-title c-gap-top-small'>$brand->title</h3>
                      </a>
                      <div class='c-row c-gap-top-small'>
                        <div class='c-span4 ec_display_flex'>
                          <a class='c-blocka ec_boxflex' href='#url'>
                            <div class='c-img ec_img_zone_showimg c-img-s'><img src='$brand->picture'></div>
                          </a>
                        </div>
                        <div class='c-span8 '>
                          <a href='#url'>
                            <ul class='ec_img_zone_abs c-color'>
                              <li class='c-gap-bottom-small'>
                                <span class='ec_icon_blue c-gap-right'>范围</span>$brand->brand_title1
                              </li>
                              <li class='c-gap-bottom-small'>
                                <span class='ec_icon_blue c-gap-right'>介绍</span>$brand->brand_title2
                              </li>
                            </ul>
                          </a>
                        </div>
                      </div>
                      <div class='ec_phone_strong_cnt c-gap-top'>
                        <div class='c-gap-top'>
                          <div class='c-row c-gap-top-small c-gap-top'>
                            <div class='c-span9 '>
                              <a class='ec_async_phone c-color c-blocka' href='tel:电话号码'>
                                $config->hospital<br> <span class='c-color-gray-a c-line-clamp1'>$config->address</span>
                              </a>
                            </div>
                            <div class='c-span3 ec_display_flex'>
                              <a class='ec_async_phone ec_strong_btn_out c-blocka' href='tel:$config->phone'>
                                <div class='c-btn'><i class='ec_font_phone'></i><span class='c-gap-left-small'>拨打</span></div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class='ec_url'>
                      <div class='ec_urlbtn'></div>
                      <div class='ec_urlline'>
                        <a href='#url'><span class='ec_site c-color-url'>$brand->xslink</span></a>
                        <span class='ec_vlogo c-gap-left'><i class='ec_font_v3'></i></span>
                      </div>
                    </div>
                  </div>
                </div>";
        }
        foreach ($defaults as $key => $default) {
            $htmlStr .=
                "<div class='c-container ec_resitem ec_wise_ ec_adv_last' id='ec_wise_adtopnum' adtopnum='1' style='display:block !important;visibility: visible !important;'>
                  <a class='ec_title c-blocka' href='#url'>
                    <h3 class='c-title c-gap-top-small'>$default->title</h3>
                  </a>
                  <div class='c-row c-gap-top-small'>
                    <div class='c-span3 ec_display_flex'>
                      <a class='c-blocka ec_boxflex' href='$default->link>
                        <div class='c-img  c-img-s'><img src='$default->picture'></div>
                      </a>
                    </div>
                    <div class='c-span9'>
                      <a class='c-blocka c-color' href='#url'>
                        <div class='c-color'>$default->depict</div>
                      </a>
                      <div class='ec_url'>
                        <div class='ec_urlbtn'></div>
                        <div class='ec_urlline'>
                          <a href='$default->link'><span class='ec_site c-color-url'>$default->xslink</span></a>
                          <span class='ec_vlogo c-gap-left'><i class='ec_font_v3'></i></span>
                          <a href='http://e.baidu.com/m2/' target='_blank'>
                            <span class='c-gray c-gap-left ec_tg'>广告</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
        }
        return $htmlStr;
    }
}