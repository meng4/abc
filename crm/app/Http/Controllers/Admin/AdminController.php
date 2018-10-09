<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
class AdminController extends CommonController{
    /**
     * 管理员列表展示
     */
    public function admin(){
        return view('admin.admin.admin');
    }
    /**
     * 加载展示数据
     */
    public function adminList(){
        //查询数据
        $where = ['admin_status' => 1];
        $admin_data = DB::table('admin') -> where( $where ) -> get();
        $admin_data = json_decode($admin_data,true);
        //循环处理数据\
//        print_r($admin_data);exit;
        foreach( $admin_data as $k => &$v ){
            $v['admin_ctime'] = date('Y-m-d H:i:s',$v['admin_ctime']);
            if( !empty($v['admin_utime']) ){
                $v['admin_utime'] = date('Y-m-d H:i:s',$v['admin_utime']);
            }
            if( $v['admin_status'] == 1 ){
                $v['status'] = '正常';
            }
        }
//        print_r($admin_data);exit;
        //总条数
        $admin_count = DB::table('admin') -> where( $where ) -> count();
        //返回数据
        $arr=[
            'code' => 0,
            'msg' => 'success',
            'count' => $admin_count,
            'data' => $admin_data
        ];
        echo json_encode($arr);exit;
    }
    /**
     * 加载添加视图
     */
    public function adminAdd(){
        return view('admin.admin.adminAdd');
    }
    /**
     * 执行添加
     */
    public function adminDo(){
        #接收数据
        $admin = input::get();
        #验证管理员唯一
        $where = ['admin_name' => $admin['admin_name']];
        $admin_data = DB::table('admin') -> where($where) -> first();
        if( $admin_data ){
            return $this -> fail('该管理员名称已存在！');
        }
        if( empty($admin['admin_status']) ){
            $admin['admin_status'] = 2;
        }
        if( $admin['admin_status'] == 'true' ){
            $admin['admin_status'] = 1;
        }
        $pwd = md5($admin['admin_pwd'].$admin['admin_name']);
        $admin['admin_pwd'] = $pwd;
        $admin['admin_ctime'] = time();
        unset($admin['_token']);
//        print_r($admin);exit;
        #执行添加
        $res = DB::table('admin') -> insertGetId($admin);
        if( $res ){
            return $this -> win('添加成功！');
        }else{
            return $this -> fail('添加失败，请重试！');
        }
    }
    /**
     * 删除管理员
     */
    public function adminDel(){
        #接收删除id
        $id = input::get('admin_id');
        $where = ['admin_id' => $id];
        $data = [
            'admin_status' => 2,
            'admin_utime' => time()
        ];
        $res = DB::table('admin') -> where( $where ) -> update($data);
        if( $res ){
            return $this -> win('删除成功！');
        }else{
            return $this -> fail('删除失败，请重试！');
        }
    }
    /**
     * 加载修改视图
     */
    public function adminUpdata(){
        #接收修改的id
        $id = input::get('admin_id');
//        echo $id;exit;
        if( empty($id) ){
            return $this -> fail('请选择要编辑的管理员id！');
        }
        $where = [
            'admin_id' => $id,
//            'admin_status' => 1
        ];
        $admin = (array) DB::table('admin') -> where( $where ) -> first();
        return view('admin.admin.adminUpdata',['admin' => $admin]);
    }
    /**
     * 执行修改
     */
    public function adminUp(){
        $admin = input::get();
//        print_r($admin);exit;
        if( empty($admin) ){
            return $this -> fail( '数据未找到，请重试！' );
        }
        $old_name = $admin['old_name'];
        $name = $admin['admin_name'];
        $data = DB::table('admin') -> where( 'admin_name','!=',$old_name ) -> where( 'admin_name','=',$name ) -> first();
//        print_r($data);exit;
        if( !empty($data) ){
            return $this -> fail('管理员名称已存在，请重试！');
        }
        if( $admin['admin_status'] == 'on' || $admin['admin_status'] == 'true' ){
            $status = 1;
        }else{
            $status = 2;
        }
        $where = ['admin_id' => $admin['id']];
        $pwd = md5($admin['admin_pwd'].$admin['admin_name']);
        $data = [
            'admin_name' => $admin['admin_name'],
            'admin_pwd' => $pwd,
            'admin_status' => $status,
            'admin_utime' => time()
        ];
        $res = DB::table('admin') -> where( $where ) -> update($data);
        if( $res ){
            return $this -> win('修改成功！');
        }else{
            return $this -> fail('修改失败，请重试！');
        }
    }
}