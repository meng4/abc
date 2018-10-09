<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
class LoginController extends CommonController{
    /**
     * 加载登录视图
     */
    public function login(){
        return view('admin.login.login');
    }
    /**
     * 执行登录
     */
    public function loginDo(){
        $admin = input::post();
        if( empty( $admin['name'] ) ){
            return $this -> fail('请填写用户名！');
        }
        if( empty( $admin['pwd'] ) ){
            return $this -> fail('请填写密码！');
        }
        #验证用户名
        $where = ['admin_name' => $admin['name']];
        $admin_data = (array) DB::table('admin') -> where( $where ) -> first();
        if( empty( $admin_data ) ){
            return $this -> fail('用户名不存在，请重试！');
        }
        $pwd = md5($admin['pwd'].$admin_data['admin_name']);
        if( $pwd == $admin_data['admin_pwd'] ){
            return $this -> win('登录成功！');
        }else{
            return $this -> fail('账号密码错误，请重试！');
        }
    }
}