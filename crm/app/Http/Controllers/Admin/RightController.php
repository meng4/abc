<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
class RightController extends Controller{
    /**
     * 加载权限视图
     */
    public function right(){
        return view('admin.right.right');
    }
    /**
     * 加载展示数据
     */
    public function rightList(){
        #查询展示数据
//        $where = ['right_status' => 1];
        $right_data = DB::table('right') -> get();
        $right_data = json_decode( $right_data ,true );
//        print_r($right_data);exit;
        foreach( $right_data as $k => &$v ){
            $v['right_ctime'] = date( 'Y-m-d H:i:s' , $v['right_ctime'] );
            if( !empty( $v['right_utime'] ) ){
                $v['right_utime'] = date( 'Y-m-d H:i:s' , $v['right_utime'] );
            }
            if( $v['right_status'] == 1 ){
                $v['status'] = '启用';
            }else{
                $v['status'] = '不启用';
            }
            if( $v['right_level'] == 1 ){
                $v['right_level'] = '一级';
            }else if( $v['right_level'] == 2 ){
                $v['right_level'] = '二级';
            }else if( $v['right_level'] == 3 ){
                $v['right_level'] = '三级';
            }
        }
//        print_r($right_data);exit;
        #查询总条数
        $right_count = DB::table( 'right' ) -> count();
        #返回数据
        $arr=[
            'code' => 0,
            'msg' => 'success',
            'count' => $right_count,
            'data' => $right_data
        ];
        echo json_encode($arr);exit;
    }
}