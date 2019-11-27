<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\req\CateModel;
use App\req\NavModel;
use App\req\NewModel;
class CateController extends Controller
{
    // 分类添加
    public function cate_add(Request $request)
    {
        $info=$request->session()->get('userinfo');

        // c查询 导航id
        $nav=NavModel::get();
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            if (empty($data['cname'] && $data['nav_id'])) {
                echo "不能为空";die;
            }
            $info = CateModel::where('cname',$data['cname'])->first();
            if(!empty($info)){
                return "<script>alert('已存在');parent.location.href='/admin/cate_add';</script>";die;
            }
            $data['add_time']=time();
            $res = CateModel::create($data);
            if ($res){
                echo 1;die;
            }else{
                echo 2;die;
            }

        }
        return view("admin.cate.add",['info'=>$info,'nav'=>$nav]);
    }
    // 分类 展示
    public function cate_index(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $index=CateModel::join('nav',"cate.nav_id","=","nav.nav_id")->paginate(5);
        return view("admin.cate.index",['index'=>$index,'info'=>$info]);
    }
    // 分类 删除
    public function cate_del(Request $request)
    {
        $cid = $request->all();
        $where = [
            'new.cid'=>$cid
        ];
        $data=CateModel::join('new','cate.cid','=','new.cid')->where($where)->get();
        if (!empty($data)){
            return "<script>alert('分类下有子分类不可删除');parent.location.href='/admin/cate_index';</script>";die;
        }
        $res = CateModel::where($where)->delete();
        if ($res) {
            return redirect("/admin/cate_index");
        }
        return redirect()->back();
    }
    //分类 修改
    public function cate_update(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $data = $request->except('_token');
        $where = [
            'cid'=>$data['cid']
        ];
        if ($request->isMethod('post')) {
            $res = CateModel::where($where)->update($data);
            if($res){
                echo 1;die;
            }
        }

        $nav=NavModel::get();
        $aa=cateModel::where($where)->first();
        return view("admin.cate.update",['data'=>$nav,'info'=>$info,'aa'=>$aa]);
    }
}
