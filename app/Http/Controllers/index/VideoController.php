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

        if(!empty($data['playlinks']['youku'])){
            $shi = $data['playlinks']['youku'];
        }else if (empty($data['playlinks']['youku'])){
            $shi = $data['playlinks']['qq'];
        }else if(empty($data['playlinks']['qq'])){
            $shi = $data['playlinks']['leshi'];
        }else if(empty($data['playlinks']['leshi'])){
            $shi = $data['playlinks']['pptv'];
        }else if(empty($data['playlinks']['pptv'])){
            $shi = $data['playlinks']['sohu'];
        }

        return view("index.video",['arr'=>data_arr(),'video_arr'=>$data,'shi'=>$shi]);
    }
    public function del_cache()
    {
        fulshall();
        return redirect('/index/video');
    }
}
