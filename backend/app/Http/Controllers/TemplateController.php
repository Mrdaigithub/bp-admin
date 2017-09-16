<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
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
    public function index($uid)
    {
        $user = Users::where('uid', $uid)->first();
        $config = $user->config->first();
        $ads = $user->ad()->orderBy('id', 'asc')->get();
        $htmlStr ="";
        if ($config->piaoimg !== '') {
            $htmlStr .=
                "<div style=' border:1px solid #d9d9d9; margin:6px 0;'>
                <a href='$config->piaourl'><img src='$config->piaoimg' width='100%'></a>
            </div>";
        }
        foreach ($ads as $key => $ad) {
            if ($ad->type === 'brand') {
                $htmlStr .=
                    "<div class='ec_ad_results' sourceid='160' posid='1' prank='1'style='display:block !important;visibility: visible !important;'>
                    <div class='c-container ec_resitem ec_wise_pp' style='display:block !important;visibility: visible !important;'>
                        <div class='ec_img_zone'>
                            <a class='ec_title c-blocka' href='$ad->link'>
                                <h3 class='c-title c-gap-top-small'>$ad->title</h3>
                            </a>
                            <div class='c-row c-gap-top-small'>
                                <div class='c-span4 ec_display_flex'>
                                    <a class='c-blocka ec_boxflex' href='$ad->link'>
                                        <div class='c-img ec_img_zone_showimg c-img-s'><img src='$ad->picture'></div>
                                    </a>
                                </div>
                                <div class='c-span8'>
                                    <a href='$ad->brand_link'>
                                        <ul class='ec_img_zone_abs c-color'>
                                            <li class='c-gap-bottom-small'>
                                                <span class='ec_icon_blue c-gap-right'>范围</span>$ad->brand_description1
                                            </li>
                                            <li class='c-gap-bottom-small'>
                                                <span class='ec_icon_blue c-gap-right'>介绍</span>$ad->brand_description2
                                            </li>
                                        </ul>
                                    </a>
                                </div>
                            </div>
                            <div class='ec_phone_strong_cnt c-gap-top'>
                                <div class='c-gap-top'>
                                    <div class='c-row c-gap-top-small c-gap-top'>
                                        <div class='c-span9 '>
                                            <a class='ec_async_phone c-color c-blocka' href='tel:$config->phone'>
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
                                <a href='$ad->link'><span class='ec_site c-color-url'>$ad->show_link</span></a>
                                <span class='ec_vlogo c-gap-left'><i class='ec_font_v2'></i></span>
								<span class='c-gap-left ec-tuiguang'>广告</span>
                            </div>
                        </div>
                    </div>
                </div>";
            } elseif ($ad->type === 'default') {
                $htmlStr .=
                    "<div class='c-container ec_resitem ec-new2  ec_wise_pp' style='display:block !important;visibility: visible !important;'>
					  <div><a class='c-blocka ec_title ' href='$ad->link'>
						<h3 class='c-title c-color-link c-gap-top-small c-gap-bottom-small'>$ad->title</h3>
						</a>
						<div class='c-row c-gap-top-small'>
						  <div class='c-span4'><a href='$ad->link' class='ec-left-img c-blocka ec-mt-2062'>
							<div class='c-img c-img-s'><img src='$ad->picture'></div>
							</a></div>
						  <div class='c-span8  ec-span8-desc'>
							<div><a href='$ad->link' class='c-blocka'>
							  <p class='c-line-clamp4 c-color'>$ad->description</p>
							  </a></div>
						  </div>
						</div>
						<div class=' c-showurl c-line-clamp1 c-gap-top-small'><span class='ec_urlbtn'></span>
						  <div class='ec_urlline'><a href='$ad->link' class='ec-showurl-line'><span class='c-showurl'>$ad->show_link</span></a><span class='c-gap-left ec-vicon'><i class='ec_font ec_font_v2'></i></span><span class='c-gap-left ec-tuiguang'>广告</span></div>
						</div>
					  </div>
					</div>";
            } elseif ($ad->type === 'defaulttext') {
                $htmlStr .=
                    "<div class='c-container ec_resitem ec-new2  ec_wise_pp ec_adv_last' style='display:block !important;visibility: visible !important;'><div><a class='c-blocka ec_title' href='$ad->link'><h3 class='c-title c-color-link c-gap-top-small c-gap-bottom-small'>$ad->title</h3><p class='c-line-clamp3 c-color '>$ad->description</p></a><div class='c-showurl c-line-clamp1 c-gap-top-small'><span class='ec_urlbtn'></span><div class='ec_urlline'><a href='$ad->link' class='ec-showurl-line'><span class='c-showurl'>$ad->show_link</span></a><span class='c-gap-left ec-vicon'><i class='ec_font ec_font_v2'></i></span><span class='c-gap-left ec-tuiguang'><i class='c-icon c-gap-right-small'>&#xe62a;</i>393</span></a><span class='c-gap-left ec-tuiguang'>广告</span></div></div></div></div>";
            } elseif ($ad->type === 'doctor') {
                $htmlStr .=
                    "<div class='c-container'><a href='$ad->link' class='c-blocka'><h3 class='c-title c-gap-top-small'>$ad->title</h3></a><a href='$ad->link' class='c-blocka'><div class='c-row c-gap-top-small wa-bk-polysemy-origin-row'><div class='c-span4 wa-bk-polysemy-miaodong'><div class='c-img c-img-s' style='background:none'><img src='$ad->picture'><div class='wa-bk-polysemy-miaodong-mask'></div></div></div><div class='c-span8 wa-bk-polysemy-origin-intro'><p class='c-color wa-bk-polysemy-clamp c-line-clamp5 wa-bk-polysemy-lineh'>姓名：$ad->doctor_name<br>职业：$ad->doctor_job<br>简介：$ad->description<br></p></div></div></a><div class='c-row c-gray c-line-clamp1'><div class='ec_urlline'><div class='c-line-clamp1'><span class='c-color-gray'>$ad->show_link</span></div></div><div class='c-span6'><div class='c-blocka c-moreinfo'></div></div></div></div>";
            }
        }
        return $htmlStr;
    }
}
