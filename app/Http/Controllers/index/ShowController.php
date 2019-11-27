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
class ShowController extends Controller
{
    // 内容
    public  function show(Request $request)
    {
        //开缓冲
        ob_start();
        $new_id=$request->input('new_id');// 接new_id
        $keys = "shownew".$new_id;// 定义 key
        $filename = "./cache/".$keys.".html";// 定义存放路径

        $baseDir = "./cache/";// 如果没有此目录创建
        if (!is_dir($baseDir)) {
            mkdir($baseDir,0,777);
        }
        if (file_exists($filename)) {
            $contents = file_get_contents($filename);
            echo $contents;die;
        }else{
            $show=$this->red($new_id);
            echo view("index.shownews",['arr'=>data_arr(),'show'=>$show]);
        }
        $con = ob_get_contents();
        file_put_contents($filename,$con);
    }
    // 方法
    public function show_new($new_id)
    {
        NewModel::where(['new_id'=>$new_id])->increment('num',1);//自增
        $res=NewModel::where('new_id',$new_id)->first();
        $show=CateModel::where('cid',$res['cid'])->get();
        foreach($show as $k=>$v){
            $show[$k]['son']=NewModel::join('voice',"new.new_id","=","voice.new_id")->where("new.new_id",$new_id)->paginate(1);
        }
        return $show;
    }
    // 存入缓存
    public function red($new_id)
    {
        $keys = "shownew".$new_id;// 定义 key
        $redis = new \Redis();// 连接 redis
        $redis->connect('127.0.0.1');
        if(empty($redis->get($keys))){
            $show = $this->show_new($new_id);
            $show =json_encode($show, true, JSON_UNESCAPED_UNICODE);
            $redis->set($keys,$show,86400);// 存入redis
            $arr = $redis->get($keys);
            $array=json_decode($arr,true);
        }else{
            $arr = $redis->get($keys);
            $array=json_decode($arr,true);
        }
        return $array;
    }
}
