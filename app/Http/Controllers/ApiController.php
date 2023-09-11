<?php
/**
 * IndexController.php
 * User: Joe
 * Date: 2023/8/21
 * Time: 13:50
 */
namespace App\Http\Controllers;

use App\Model\BaiDuQianFan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ApiController extends BaseController {

    public function chat() {
        $text = request('text', '');
        if (empty($text)) {
            return response()->json([
                'code' => 400,
                'msg' => '请输入你的问题。',
                'data' => ''
            ]);
        }

        $chat_limit = Redis::get('book:mongodb:chat_limit');
        if ($chat_limit < 10) {
            return response()->json([
                'code' => 500,
                'msg' => '请求超限，请联系管理员。',
                'data' => ''
            ]);
        }

        $template = '你的名字是Joe书店助手，你扮演的角色是一个阅读助手。我是一个阅读爱好者，你回答的内容只能和书籍，作者，出版社有关，除了书籍，作者，出版社之外的信息不要返回。我的问题是：' . $text;
        try {
            $result = BaiDuQianFan::chat($template);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 400,
                'msg' => '内部错误，请联系管理员。',
                'data' => ''
            ]);
        }
        Log::info('chat-message>>> ip:' . request()->ip() . ', input: ' . $text . ', result: ' . $result);

        Redis::set('book:mongodb:chat_limit', ($chat_limit - 1));
        return response()->json([
            'code' => 200,
            'msg' => '',
            'data' => $result
        ]);
    }
}

