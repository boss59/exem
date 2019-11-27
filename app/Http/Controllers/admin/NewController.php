<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\req\NavModel;
use  App\req\NewModel;
use  App\req\CateModel;
use Monolog\Handler\IFTTTHandler;

class NewController extends Controller
{
    // 新闻 添加
    public function new_add(Request $request)
    {
        //查询 导航 分类
        $coo=CateModel::join('nav',"cate.nav_id","=","nav.nav_id")->get();
        $info=$request->session()->get('userinfo');
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $data['new_img']=add_img($data['new_img'],'/new/');// 上传 imgs
            if (empty($data['title'] && $data['cid'] && $data['new_desc'])) {
                return "<script>alert('不能为空');parent.location.href='/admin/new_add';</script>";die;
            }
            $info = NewModel::where('title',$data['title'])->first();
            if(!empty($info)){
                return "<script>alert('已存在');parent.location.href='/admin/new_add';</script>";die;
            }
            $data['add_time']=time();
            $res = NewModel::create($data);
            if ($res){
                echo 1;die;
            }else{
                echo 2;die;
            }

        }
        return view("admin.new.add",['info'=>$info,'coo'=>$coo]);
    }
    // 新闻 展示
    public function new_index(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $where = [];
        $query = $request->input();
//        dd($query);
        // 分类
        if (!empty($request->input('cid'))) {
            $where[]=['new.cid','=',$request->input('cid')];
        }
        // 关键字 条件搜索
        if (!empty($request->input('title'))){
            $where [] = ['new.title','like',"%".$request->input('title')."%"];
        }
        // 热门  条件搜索
        $is_hot = $request->input('is_hot');
        if ($is_hot == "0" || $is_hot == "1") {
            $where[]=['new.is_hot','=',$is_hot];
        }
        // 展示  条件搜索
        $new_show = $request->input('new_show');
        if ($new_show == "0" || $new_show == "1") {
            $where[]=['new.new_show','=',$new_show];
        }

        $index=NewModel::join('cate',"new.cid","=","cate.cid")->where($where)->paginate(5);
        // 查询 分类
        $cate=CateModel::get();
        return view("admin.new.index",compact('index','query','cate',"info"));
    }
    // 新闻 删除
    public function new_del(Request $request)
    {
        $user_id = $request->all();
        // dd($user_id);
        $where = [
            'new_id'=>$user_id
        ];
        $data = NewModel::where($where)->first();
        $file = "D:/phpstudy_pro/WWW/laravel/public".$data['new_img'];
        if (file_exists($file)) {
            unlink($file);
            $res = NewModel::where($where)->delete();
            if ($res) {
                return redirect("/admin/new_index");
            }
            return redirect()->back();
        }
    }
    // 新闻 修改
    public function new_update(Request $request)
    {
        $info=$request->session()->get('userinfo');

        $all = $request->except('_token');
        $where = [
            'new_id'=>$all['new_id']
        ];
        $aa = NewModel::where($where)->first();
        $file = "D:/phpstudy_pro/WWW/laravel/public".$aa['new_img'];
        if($request->isMethod('POST')){
            if (file_exists($file)) {
                unlink($file);
            }
            // 文件
            $all['new_img']=add_img($all['new_img'],'/new/');
            $res = NewModel::where($where)->update($all);
            if($res){
                echo 1;die;
            }
        }
        $cate=cateModel::get();
        $new=NewModel::where($where)->first();
        return view("admin.new.update",['info'=>$info,'new'=>$new,'cate'=>$cate]);
    }

    // 新闻详情
    public function details(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $id = $request->input('new_id');
        $where = [
            'new_id'=>$id
        ];
        $new=NewModel::where($where)->first();
        $desc = $new['new_desc'];
        return view("admin.new.details",['info'=>$info,'desc'=>$desc]);
    }
    // 即点 即改 热门
    public function is_hot(Request $request)
    {
        $all = $request->input();
        $res=NewModel::where('new_id',$all['new_id'])->update($all);
        echo 1;
    }
}
