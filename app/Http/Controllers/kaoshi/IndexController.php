<?php

namespace App\Http\Controllers\kaoshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\req\RegistModel;
use App\req\GoodsModel;
class IndexController extends Controller
{
    // 注册
    public function reg(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            if (empty($data['uname'] && $data['upwd'] && $data['tel'])) {
                echo "不能为空";die;
            }
            if (strlen($data['tel'])<11) {
                echo "请输入正确的手机号";die;
            }
//            $info=RegistModel::where("uname",$data['uname'])->first();
//            if (!empty($info)){
//                echo "用户已存在";die;
//            }
            $check = '/^(1(([35789][0-9])|(47)))\d{8}$/';
            if (!preg_match($check,$data['tel'])) {
                echo "请输入合法的手机号";die;
            }
            $data['upwd']=md5($data['upwd']);
            $res = RegistModel::create($data);
            $data['access']=md5(uniqid());

            $redis = new \Redis();
            $redis->connect("127.0.0.1",6379);
            $redis->set($data['access'],1,60*5);
            if ($res){
                echo "恭喜你，注册成功！！你的appkey是".$data['access'];
            }else{
                return redirect()->back();
            }


        }
        return view("kaishi.reg");
    }

    // 返回数据
    public function index(Request $request)
    {
        $key = "goods";

        $token = $request->input('access_token');
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
                $redis->set($token,$num+1,5*60);
            }
        }else{
            $arr = array(
                "error"=>"4001",
                "msg"=>"token无效",
            );
            print_r($arr);exit;
        }


        if (empty($redis->get($key))){
            echo "数据库.<br />";
            $info=GoodsModel::get();
            $arr = json_encode($info,JSON_UNESCAPED_UNICODE);
            $redis->set($key,$arr);
        }else{
            echo "缓存.<br />";
            $arr = $redis->get($key);
        }
        return $arr;
    }
}
