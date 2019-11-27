<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    // 前台 首页
    public function index()
    {
        // 开ob 缓冲
        ob_start();
        if (file_exists("./cache/index.html")){
            $contents = file_get_contents("./cache/index.html");
            echo $contents;die;
        }else{
            echo view("index.index",['arr'=>data_arr(),'array'=>about($cid= "")]);
        }
        $con = ob_get_contents();
        file_put_contents("./cache/index.html",$con);
    }
}
