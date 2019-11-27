<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\req\LinkModel;
class LinkController extends Controller
{
    // 友链 添加
    public function link_add(Request $request)
    {
        $info=$request->session()->get('userinfo');

        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            if (empty($data['fname'] && $data['furl'])) {
                echo "不能为空";die;
            }
            $info = LinkModel::where('fname',$data['fname'])->first();
            if(!empty($info)){
                echo 2;
            }
            $data['add_time']=time();
            $res = LinkModel::create($data);
            if ($res){
                echo 1;die;
            }else{
                echo 2;die;
            }

        }
        return view("admin.link.add",['info'=>$info]);
    }
    // 友链 展示
    public function link_index(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $index=LinkModel::paginate(5);
        return view("admin.link.index",['index'=>$index,'info'=>$info]);
    }
    // 友链 删除
    public function link_del(Request $request)
    {
        $user_id = $request->all();
        $where = [
            'fid'=>$user_id['fid'],
        ];

        $res = LinkModel::where($where)->delete();
        if ($res) {
            return redirect("/admin/link_index");
        }
        return redirect()->back();
    }
    //友链 修改
    public function link_update(Request $request)
    {
        $info=$request->session()->get('userinfo');
        $user_id = $request->all();
        $where = [
            'user_id'=>$user_id
        ];
        if($request->isMethod('POST')){
            $all = $request->except('_token');
            $res = AdminModel::where($where)->update($all);
            if($res){
                return redirect("/admin/admin_index");
            }
            return redirect()->back();
        }
        $aa = AdminModel::where($where)->first();
        return view("admin.user.update",['data'=>$aa,'info'=>$info]);
    }
}
