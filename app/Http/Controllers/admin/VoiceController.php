<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\req\VoiceModel;
use App\req\NewModel;
class VoiceController extends Controller
{
    // 新闻voice 添加
    public function voice_add(Request $request)
    {
        $info=$request->session()->get('userinfo');
        // 新闻voice 添加
        $new=NewModel::get();
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $voice=VoiceModel::where('new_id',$data['new_id'])->first();
            if(!empty($voice)){
                echo 2;die;
            }
            $data['voice']=add_img($data['voice'],'/voice/');
            $data['add_time']=time();
            $res = VoiceModel::create($data);
            if ($res){
                echo 1;die;
            }else{
                echo 2;die;
            }
        }
        return view("admin.voice.add",['info'=>$info,"new"=>$new]);
    }
    // 新闻voice 展示
    public function voice_index(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $index=NewModel::join('voice',"new.new_id","=","voice.new_id")->paginate(5);
        return view("admin.voice.index",['info'=>$info,"new"=>$index]);
    }
}
