<?php
use Illuminate\Support\Facades\Storage;
use App\req\NavModel;
use App\req\CateModel;
use App\req\linkModel;
use App\req\ProductModel;
use App\req\ImgModel;
use App\req\NewModel;
function sym_encrpty($str,$key){      //对称加密
    $target="";
    for ($i=0;$i<strlen($str);$i++){
        $target.=$str[$i]^$key;
    }
    return base64_encode($target);;
}

function sym_decrpty($str,$key){      //对称解密
    $str=base64_decode($str);
    $target="";
    for($i=0;$i<strlen($str);$i++){
        $target.=$str[$i]^$key;
    }
    return $target;
}



function curl_post($url,$data)       //curl的post方法     $url 接口路径   $data 接口参数
{
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function curl_get($url)            //curl的post方法     $url 接口路径
{
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function arr_dir($arr)
{
    $baseDir= Date("Y/m/d/",time());
    $path=storage_path("logs/api/".$baseDir."");
    if (!is_dir($path)) {
        mkdir($path,0,777);
    }
    file_put_contents($path.date('Y-m-d').'.txt',"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
    file_put_contents($path.date('Y-m-d').'.txt',"$arr\n",FILE_APPEND);
}

function endMail($email)
{
    $msg = "恭喜你，注册成功";
    \Mail::raw($msg ,function($message)use($email){
        //设置主题
        $message->subject("注册邮件发送");
        //设置接收方
        $message->to($email);
    });
}
function add_img($file,$pathname)
{
    if (empty($file)){
        return redirect()->back();
    }
    $time = date('Ymd',time());
    // 获取文件相关信息
    $originalName = $file->getClientOriginalName(); // 文件原名
    $ext = $file->getClientOriginalExtension();     // 扩展名
    $realPath = $file->getRealPath();   //临时文件的绝对路径
    $type = $file->getClientMimeType();     // image/jpeg
    // 上传文件
    $filename = uniqid() . '.' . $ext;
    $img_path=$data['pic_path'] = $pathname.$time.'/'.$filename;
    // 使用我们新建的uploads本地存储空间（目录）
    //这里的uploads是配置文件的名称
    $bool = Storage::disk('uploads')->put($img_path, file_get_contents($realPath));

    $path = '/imgs'.$img_path;
    return $path;
}












// ==============  企业站 =============================
//导航
function data_arr()
{
//    $nav=NavModel::Leftjoin("cate","nav.nav_id","=","cate.nav_id")->orderBy('nav.nav_weight',"desc")->get()->toarray();
    $nav=NavModel::orderBy('nav.nav_weight',"desc")->get()->toarray();
    $img=ImgModel::where(['is_sh'=>1])->get()->toarray();

    $product=ProductModel::get()->toarray();

    $link=linkModel::get()->toarray();

    $cate = CateModel::get()->toarray();

    $data = ['nav'=>$nav,'img'=>$img,'product'=>$product,'link'=>$link,'cate'=>$cate];
    return $data;
}

function about($cid)
{
    if (empty($cid)){
        $array = CateModel::get()->toArray();
        foreach($array as $k=>$v){
            $array[$k]['son']=NewModel::join('voice',"new.new_id","=","voice.new_id")->where("cid",$v['cid'])->orderBy("new.new_id","desc")->get()->toArray();
        }
    }else{
        $array=CateModel::where('cate.cid',$cid)->get()->toarray();
        foreach($array as $k=>$v){
            $array[$k]['son']=NewModel::join('voice',"new.new_id","=","voice.new_id")->where("cid",$v['cid'])->orderBy("new.new_id","desc")->get()->toArray();
        }
    }
    return $array;
}

// 接口 视频
function video_arr($name)
{
    $keys = "video";
//    \Cache::forget($keys);die;
    //判断缓存是否存在
    if(\Cache::has($keys)) {
        //取缓存
        $arr = \Cache::get($keys);
    }else{
        //取不到，调接口，缓存
        $key = "3fc119a0d8ac4740ad1ca075cab0631e";
        $url = "http://api.avatardata.cn/Movie/Query?key=".$key."&name=".$name;
        $res=curl_get($url);
        $result = json_decode($res,true,JSON_UNESCAPED_UNICODE);
        \Cache::put($keys,$result['result'],86400);
        $arr = $result['result'];
    }
    return  $arr;
}
// 段子接口
function  jokes()
{
    // 连接redis
    $redis = new \Redis();
    $redis->connect('127.0.0.1');
    $keys = "jokes";
    if (empty($redis->get($keys))){
        //取不到，调接口，缓存
        $key = "d7ec41cfe9054139811bf464562c3499";
        $res=file_get_contents("http://api.avatardata.cn/Joke/QueryJokeByTime?key=".$key."&page=2&rows=20&sort=asc&time=1418745237");
        $redis->set($keys,$res,86400);
        $arr = json_decode($res,true);
    }else{
        $arr = $redis->get($keys);
        $arr=json_decode($arr,true);
    }
    return  $arr;
}
function fulshall()
{
    $keys = "video";
    \Cache::forget($keys);
}





?>