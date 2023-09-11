<?php
/**
 * BaseController.php
 * User: Joe
 * Date: 2023/8/22
 * Time: 10:35
 */
namespace App\Http\Controllers;


class BaseController extends Controller {
    public function jumpToErrorPage($error_message) {
        return view('error', [
            'error_message' => $error_message
        ]);
    }
}
