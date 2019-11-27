<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\restful\MusicModel;
class UserController extends Controller
{
    // api 添加 数据
    public function info()
    {
        $arr=file_get_contents('https://www.mxnzp.com/api/music/recommend/list');
        $arr=json_decode($arr,1);
        foreach ($arr['data'] as $k=>$v){
            $Music=MusicModel::create([
                'author'=>$v['author'],
                'info'=>$v['info'],
                'album_title'=>$v['album_title'],
                'title'=>$v['title'],
                'si_proxycompany'=>$v['si_proxycompany'],
            ]);
            var_dump($Music);
        }
    }
    // 必须通过assecc_token 返回数据
    public function token(Request $request)
    {
        $token = $request->input('token');
        $redis = new \Redis();
        $redis->connect("127.0.0.1",6379);
        $num = $redis->get($token);
        if ($redis->get($token)){
            if($num >10 ){
                $arr = array(
                    "error"=>"4005",
                    "msg"=>"接口调用频繁 超过十次，请在下一个5分钟在调用",
                );
                print_r($arr);exit;
            }else{
                $redis->incr($token,$num);
            }
        }else{
            $arr = array(
                "error"=>"4001",
                "msg"=>"token无效",
            );
            print_r($arr);exit;
        }
        // 返回的 数据
        $info=MusicModel::get();
        $arr = json_encode($info);
        // logs  目录
        if (!empty($arr)){
            arr_dir($arr);
        }else{
            $arr = array(
                "error"=>"4009",
                "msg"=>"暂无数据",
            );
            print_r($arr);exit;
        }
        return $arr;
    }
}
