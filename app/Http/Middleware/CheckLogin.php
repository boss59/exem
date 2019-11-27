<?php

namespace App\Http\Middleware;

use Closure;
use  App\req\AdminModel;
use  App\req\RoleModel;
use  App\req\RightModel;
use  App\req\Role_RightModel;
use  App\req\Admin_RoleModel;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty($request->session()->get('userinfo'))){
            return redirect("/admin/login");
        }else{
//            $userinfo=$request->session()->get('userinfo');
//            $role=AdminModel::join('admin_role','adminuser.user_id','=','admin_role.user_id')->where('admin_role.user_id',$userinfo['user_id'])->first();//role_id
//            $role_right=Role_RightModel::where('role_id',$role['role_id'])->get();//得到right_id
//            $data="";
//            foreach ($role_right as $k=>$v){
//                $http=$request->server('HTTP_HOST');//可以获取到 $_SERVER 中的 HTTP_HOST 信息 （即访问域名）
//                $url=$request->server('REQUEST_URI'); //
//                $header='http://'.$http.$url;
//                $right=RightModel::where(['right_id'=>$v['right_id']])->where(['rig_name'=>$header])->first();
//                $data.=$right;
//            }
////            dd($data);
//            if(empty($data)){
//                echo "<script>alert('滚，你没有此权限!');location.href='" . url('/admin/index') . "';</script>";die;
//            }
        }
        return $next($request);
    }
}
