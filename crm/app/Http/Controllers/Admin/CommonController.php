<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
class CommonController extends Controller{
    /**
     * 封装正确提示
     * @param string $error 提示信息
     * @param array $data 返回数据
     * @return string
     */
    protected function win($error='ok',$data=[]){
        return json_encode([
           'status' => 1000,
            'msg' => $error,
            'data' => $data
        ]);
    }

    /**
     * 封装错误提示
     * @param string $error 提示信息
     * @param array $data 返回数据
     * @return string
     */
    protected function fail($error='no',$data=[]){
        return json_encode([
            'status' => 1,
            'msg' => $error,
            'data' => $data
        ]);
    }
}