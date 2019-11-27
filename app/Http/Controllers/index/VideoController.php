<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function video(Request $request)
    {
        $name = $request->input('video');
        $data=video_arr($name);
        return view("index.video",['arr'=>data_arr(),'video_arr'=>$data]);
    }
    public function del_cache()
    {
        fulshall();
        return redirect('/index/video');
    }
}
