<?php
/**
 * IndexController.php
 * User: Joe
 * Date: 2023/8/21
 * Time: 13:50
 */
namespace App\Http\Controllers;

class ErrorController extends Controller {
    public function index() {
        return view('error', [
            'error_message' => '错误页面，没有数据！'
        ]);
    }
}

