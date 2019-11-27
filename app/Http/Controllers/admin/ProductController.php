<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\req\ProductModel;
use App\req\CateModel;
class ProductController extends Controller
{
    // 产品 添加
    public function product_add(Request $request)
    {
        $cate=CateModel::get();
        $info=$request->session()->get('userinfo');
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $data['images']=add_img($data['images'],'/images/');// 上传 imgs
            if (empty($data['pname'] && $data['nav_id'])) {
                return "<script>alert('不能为空');parent.location.href='/admin/product_add';</script>";die;
            }
            $info = ProductModel::where('pname',$data['pname'])->first();
            if(!empty($info)){
                echo 2;die;
            }
            $data['add_time']=time();
            $res = ProductModel::create($data);
            if ($res){
                echo 1;die;
            }else{
                echo 2;die;
            }
        }
        return view("admin.product.add",['info'=>$info,'cate'=>$cate]);
    }
    // 产品 展示
    public function product_index(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $index=ProductModel::join('nav',"product.nav_id","=","nav.nav_id")->paginate(5);
        return view("admin.product.index",['index'=>$index,'info'=>$info]);
    }
    // 产品 删除
    public function product_del(Request $request)
    {
        $user_id = $request->all();
        // dd($user_id);
        $where = [
            'pid'=>$user_id
        ];
        $data = ProductModel::where($where)->first();
        $file = "D:/phpstudy_pro/WWW/laravel/public".$data['images'];
        if (file_exists($file)) {
            unlink($file);
            $res = ProductModel::where($where)->delete();
            if ($res) {
                return redirect("/admin/product_index");
            }
            return redirect()->back();
        }
    }
    // 产品 修改
    public function product_update(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $all = $request->except('_token');
        $where = [
            'pid'=>$all['pid']
        ];
        $aa = ProductModel::where($where)->first();
        $file = "D:/phpstudy_pro/WWW/laravel/public".$aa['images'];
        if($request->isMethod('POST')){
            if (file_exists($file)) {
                unlink($file);
            }
            // 文件
            $all['images']=add_img($all['images'],'/new/');
            $res = ProductModel::where($where)->update($all);
            if($res){
                echo 1;die;
            }
        }
        $nav=NavModel::get();
        $pro=ProductModel::where($where)->first();
        return view("admin.product.update",['info'=>$info,'nav'=>$nav,'pro'=>$pro]);
    }
}
