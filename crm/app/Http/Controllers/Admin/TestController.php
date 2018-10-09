<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class TestController extends Controller{
    public function test(){
        echo 111;exit;
    }
}