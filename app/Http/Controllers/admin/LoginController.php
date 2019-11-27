<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\req\AdminModel;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    // 注册
    public function regist(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            endMail($data['email']);
            if (empty($data['uname'] && $data['pwd'] && $data['tel'] && $data['email'])) {
                echo "不能为空";die;
            }
            if (strlen($data['tel'])<11) {
                echo "请输入正确的手机号";die;
            }
            $info=AdminModel::where("uname",$data['uname'])->first();
            if (!empty($info)){
                echo "用户已存在";die;
            }
            $check = '/^(1(([35789][0-9])|(47)))\d{8}$/';
            if (!preg_match($check,$data['tel'])) {
                echo "请输入合法的手机号";die;
            }
            $check = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
            if(!preg_match($check,$data['email'])){
                echo "email不和法";die;
            }
            $data['pwd']=md5($data['pwd']);
            $data['add_time']=time();
            $res = AdminModel::create($data);
            if ($res){
                $request->session()->put('userinfo',$data);
                return redirect("admin/index");
            }else{
                return redirect("admin/login");
            }

        }
    }
    // 登陆
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $remember = $request->input('remember');
            $data = $request->except('_token');
            // 验证
            // dd($data);
            $validator = \Validator::make($data, [
                'uname' => 'required',
                'pwd' => 'required',
            ],[
                'uname.required' => '名称不能为空',
                // 密码
                'pwd.required' => '密码不能为空',
            ]);
            if ($validator->fails()) {
                return redirect('/admin/Login')
                    ->withErrors($validator)
                    ->withInput();
            }
            // 用户验证
            $info = AdminModel::where('uname',$data['uname'])->first();
            if (empty($info)) {
                return "<script>alert('账号不存在');parent.location.href='/admin/Login';</script>";die;
            }else{
                //判断密码是否正确
                if ($info['pwd']==md5($data['pwd'])) {//用库里加密密码 == 接收的加密密码
                    if ($remember == 1) {// 判断 用户 勾选三天免登陆
                        $user=\Cookie::make('username',$info,3*86400);//设置 cookie
                        \Response::make()->withCookie($user);
                    }
                    $request->session()->put('userinfo',$info);
                    return "<script>alert('登陆成功');parent.location.href='/admin/index';</script>";
                }else{
                    return "<script>alert('密码不正确');parent.location.href='/admin/login';</script>";die;
                }
            }
        }
        return view("admin.login.login");
    }


    // 第三方登陆
    public function user(Request $request)
    {
        $app = urlencode(env('APP_URl').'/admin/code');
//        dd($app);
        // 第一步：用户同意授权，获取code
        $url = "location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECGAT_APPID')."&redirect_uri=".$app."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        // dd($url);
        header($url);
    }
    public function code(Request $request)
    {
        $code = request()->input('code'); // 得到code
        $token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECGAT_APPID')."&secret=".env('WECHET_SECRET')."&code=".$code."&grant_type=authorization_code");
        $userinfo = json_decode($token,1);
        $openid=$userinfo['openid'];
        // 查库
        $info=AdminModel::where('openid','=',$openid)->first();
//        dd($info);
        if (!$info){
            // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
            $info = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$userinfo['access_token']."&openid=".$userinfo['openid']."&lang=zh_CN");
            $userinfo = json_decode($info,1);
            $data =[
                'uname'=>$userinfo['nickname'],
                'openid'=>$userinfo['openid'],
            ];
            $user_id=AdminModel::insertGetId($data);//添加到用户表 获取userid
            $res=AdminModel::where('user_id','=',$user_id)->first();
            if ($res){
                $request->session()->put('userinfo',$res);
                return redirect('/admin/index');
            }else{
                return redirect()->back();
            }
        }else{
            $request->session()->put('userinfo',$info);
            return redirect('/admin/index');
        }

    }






    // 退出登陆
    public function quit(Request $request)
    {
        $request->session()->forget('userinfo');
        return redirect("admin/login");
    }


    // 邮件 放送
    public function sendMail($mail){
        $msg ="";
        \Mail::raw("aaaaaaaaaaaaaa",function($message) use ($mail){
            $message->subject("thi sis test");
            $info = $message->to($mail);
        });
    }
}
