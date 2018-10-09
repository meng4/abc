<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller{
    /**
     * 首页模板
     */
    public function index(){
        return view('admin.index.index');
    }
}