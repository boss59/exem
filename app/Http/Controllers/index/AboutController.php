<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\req\NewModel;
use App\req\NavModel;
use App\req\CateModel;
use App\req\linkModel;
use App\req\ProductModel;
use App\req\ImgModel;
use App\req\VoiceModel;
class AboutController extends Controller
{
    // 关于我们
    public function about(Request $request)
    {
        $cid = $request->input('cid');
        return view("index.about",['arr'=>data_arr(),'about'=>about($cid)]);
    }
}
