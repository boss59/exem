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
class NewController extends Controller
{
    // 新闻
    public function new(Request $request)
    {
        $cid = $request->input('cid');
        $nav_id = $request->input('nav_id');
        if (!empty($cid)){
            $title=$this->cid($cid);
        }else{
            $title=$this->nav_arr($nav_id);
        }
//        dd($title);
        return view("index.news",['arr'=>data_arr(),'title'=>$title]);
    }
    // 导航id
    public function nav($nav_id)
    {
        $array=CateModel::join('nav','cate.nav_id','=','nav.nav_id')->where(['cate.nav_id'=>$nav_id])->get()->toArray();
        if ($nav_id == 3){
            foreach($array as $k=>$v){
                $array[$k]['pro']=ProductModel::where(['cid'=>$v['cid']])->get()->toarray();
            }
        }else{
            foreach($array as $k=>$v){
                $array=about($v['cid']);
            }
        }
        return $array;
    }

    // 如果是 分类 id存入 缓存
    public function cid($cid)
    {

        // 连接redis
        $keys = "cid".$cid;
        if(\Cache::has($keys)) {
            //取缓存
            $title = \Cache::get($keys);
        }else{
            $title=about($cid);
            \Cache::put($keys,$title,86400);
        }
        return $title;
    }
    // 如果是导航id 存入 缓存
    public function nav_arr($nav_id)
    {
        $keys = "nav".$nav_id;
        if(\Cache::has($keys)) {
            //取缓存
            $title = \Cache::get($keys);
        }else{
            $title = $this->nav($nav_id);
            \Cache::put($keys,$title,86400);
        }
        return $title;
    }

}
