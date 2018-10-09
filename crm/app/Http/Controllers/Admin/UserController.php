<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
class UserController extends Controller{
    /**
     * 管理员列表展示
     */
    public function user(){
        return view("admin.user.user");
    }

    /**
     * 管理员展示
     */
    public function userList(){

//        查询数据
        $where = ['order_status' => 1];
        $user = DB::table('user')
            -> join('admin','user.admin_id','=','admin.admin_id')
            -> get();
//        print_r($user);exit;
        $str = json_decode($user,true);
        $area = [];
        foreach( $str as $k => $v ){
            $area[] = $v['province'];
            $area[] = $v['city'];
            $area[] = $v['area'];
        }
        $area_data = DB::table('area') ->select('id','area_name') -> whereIn('id',$area) -> get();
        $area_data = json_decode($area_data,true);
        $new_area=[];
        foreach( $area_data as $k => $v ){
            $new_area[$v['id']] = $v['area_name'];
        }
        foreach( $str as $kk => &$vv ){
            $vv['province'] = $new_area[$vv['province']];
            $vv['city'] = $new_area[$vv['city']];
            $vv['area'] = $new_area[$vv['area']];
        }
//        print_r($str);exit;
        //总条数
        $order_count = DB::table('user') -> count();
        $arr=[
            'code' => 0,
            'msg' => 'success',
            'count' => $order_count,
            'data' => $str
        ];
        echo json_encode($arr);exit;
    }
}