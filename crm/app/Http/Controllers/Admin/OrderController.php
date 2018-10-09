<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
class OrderController extends Controller{
    /**
     * 管理员列表展示
     */
    public function order(){
        return view("admin.order.order");
    }

    /**
     * 管理员展示
     */
    public function orderList(){
        $str = DB::table('order') -> get();
//        print_r($str);exit;
        //查询数据
        $where = ['order_status' => 1];

        $str = json_decode($str,true);
        //循环处理数据
        foreach( $str as $k => &$v ){
            $v['order_ctime'] = date('Y-m-d H:i:s',$v['order_ctime']);
            if( !empty($v['order_utime']) ){
                $v['order_utime'] = date('Y-m-d H:i:s',$v['order_utime']);
            }
            if( $v['order_status'] == 1 ){
                $v['status'] = '成功';
            }
        }
        //总条数
        $order_count = DB::table('order') -> where( $where ) -> count();
        $arr=[
            'code' => 0,
            'msg' => 'success',
            'count' => $order_count,
            'data' => $str
        ];
        echo json_encode($arr);exit;
    }

    /**
     * 管理员添加页面
     */
    public function orderDo(){
        return view("admin.order.orderDo");
    }
}