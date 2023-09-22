<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Press extends Model
{
    protected $collection = 'press';
    protected $primaryKey = 'ID';

    /**
     * 通过 id 查询出版社
     * @param $id
     * @return array
     */
    public static function getPressByID($id) {
        if (empty($id)) {
            return [];
        }
        $query = self::where('ID', intval($id))->first();
        return is_null($query) ? [] : $query->toArray();
    }

    /**
     * 通过 name 查询出版社
     * @param $press_name
     * @return array
     */
    public static function getPressByName($press_name) {
        if (empty($press_name)) {
            return [];
        }
        $query = self::where('PressName', addslashes($press_name))->first();
        return is_null($query) ? [] : $query->toArray();
    }

    /**
     * 获取当前出版社的书籍信息
     * @param $book_id_str
     * @return array
     */
    public static function getRecommendedBookByPress($book_id_str) {
        if (empty($book_id_str)) {
            return [];
        }
        $book_page = Book::getBookByID($book_id_str, true, 8);

        $book_info['data'] = $book_page['data'];
        $book_info['page'] = [
            'current_page' => $book_page['current_page'],
            'page_range' => Book::generatePageRange($book_page['current_page'], $book_page['last_page'], 4),
            'page_url' => $book_page['path'],
            'prev_page_url' => isset($book_page['prev_page_url']) ? $book_page['prev_page_url'] : '',
            'next_page_url' => isset($book_page['next_page_url']) ? $book_page['next_page_url'] : '',
        ];
        return $book_info;
    }
}
