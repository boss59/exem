<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\req\ImgModel;
class ImgController extends Controller
{
    // 轮播图 添加
    public function img_add(Request $request)
    {
        $info=$request->session()->get('userinfo');
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $data['imgs']=add_img($data['imgs'],'/blackvirus/');
            $data['add_time']=time();
            $res = ImgModel::create($data);
            if ($res){
                echo 1;die;
            }else{
                echo 2;die;
            }

        }
        return view("admin.images.add",['info'=>$info]);
    }
    // 轮播图 展示
    public function img_index(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $index=ImgModel::paginate(3);
        return view("admin.images.index",['index'=>$index,'info'=>$info]);
    }
    // 轮播图 删除
    public function img_del(Request $request)
    {
        $user_id = $request->all();
        // dd($user_id);
        $where = [
            'img_id'=>$user_id
        ];
        $data = ImgModel::where($where)->first();
        $file = "D:/phpstudy_pro/WWW/laravel/public".$data['imgs'];
        if (file_exists($file)) {
            unlink($file);
            $res = ImgModel::where($where)->delete();
            if ($res) {
                return redirect("/admin/img_index");
            }
            return redirect()->back();
        }
    }
    //轮播图 修改
    public function img_update(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $all = $request->except('_token');
        $where = [
            'img_id'=>$all['img_id']
        ];
        $aa = ImgModel::where($where)->first();
        $file = "D:/phpstudy_pro/WWW/laravel/public".$aa['imgs'];
        if($request->isMethod('POST')){
            if (file_exists($file)) {
                unlink($file);
            }
            // 文件
            $all['imgs']=add_img($all['imgs'],'/blackvirus/');
            $res = ImgModel::where($where)->update($all);
            if($res){
                echo 1;die;
            }
        }
        return view("admin.images.update",['data'=>$aa,'info'=>$info]);
    }
}
