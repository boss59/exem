<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\req\NavModel;
use  App\req\CateModel;
class NavController extends Controller
{
    // 导航 添加
    public function nav_add(Request $request)
    {
        $info=$request->session()->get('userinfo');
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            if (empty($data['nav_name'] && $data['nav_url'] && $data['nav_weight'] && $data['is_show'])) {
                echo "不能为空";die;
            }
            $data['add_time']=time();
            $res = NavModel::create($data);
            if ($res){
                echo 1;die;
            }else{
                echo 2;die;
            }

        }
        return view("admin.nav.add",['info'=>$info]);
    }
    // 导航 展示
    public function nav_index(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $index=NavModel::paginate(3);
        return view("admin.nav.index",['index'=>$index,'info'=>$info]);
    }
    // 导航 删除
    public function nav_del(Request $request)
    {
        $nav_id = $request->all();
        $where = [
            'cate.nav_id'=>$nav_id
        ];
        $data=NavModel::join('cate','nav.nav_id','=','cate.nav_id')->where($where)->get();
        if (!empty($data)){
            return "<script>alert('分类下有子分类不可删除');parent.location.href='/admin/nav_index';</script>";die;
        }
        $res = NavModel::where($where)->delete();
        if ($res) {
            return redirect("/admin/nav_index");
        }
        return redirect()->back();
    }
    // 导航 修改
    public function nav_update(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $data = $request->except('_token');
        $where = [
            'nav_id'=>$data['nav_id']
        ];
        if($request->isMethod('POST')){
            $res = NavModel::where($where)->update($data);
            if($res){
                echo 1;die;
            }
        }
        $aa = NavModel::where($where)->first();
        return view("admin.nav.update",['info'=>$info,'data'=>$aa]);
    }
}
