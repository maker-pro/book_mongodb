<?php

namespace App\Model;

use Illuminate\Support\Facades\Redis;
use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model
{
    protected $collection = 'books';
    protected $primaryKey = 'ID';

    /**
     * 通过 book_id 查询书籍信息
     * @param $id
     * @param bool $is_paginate
     * @param int $page_size
     * @return array
     */
    public static function getBookByID($id, bool $is_paginate = false, int $page_size = 20): array
    {
        $id = self::checkID($id);
        if (empty($id)) {
            return [];
        }
        $query = self::whereIn('ID', $id);
        if ($is_paginate) {
            $res = $query->paginate($page_size);
        } else {
            if (count($id) == 1) {
                $res = $query->first();
            } else {
                $res = $query->get();
            }
        }
        return is_null($res) ? [] : $res->toArray();
    }

    /**
     * 把 book_id 字符串转数组
     * @param $id|string
     * @return array|bool
     */
    public static function checkID($id) {
        if (empty($id)) {
            return false;
        }
        $result_ids = [];
        foreach (explode(',', $id) as $item) {
            $item = intval($item);
            if ($item !== 0) {
                $result_ids[$item] = 1;
            }
        }
        return array_keys($result_ids);
    }

    /**
     * 通过 category_id 获取推荐的书籍信息
     * @param $category_id
     * @param string $category_type
     * @param bool $curr_book_id
     * @return array
     */
    public static function getRecommendedBookByCategory($category_id, string $category_type = 'One', bool $curr_book_id = false): array
    {
        if (empty($category_id)) {
            return [];
        }
        $category_id = intval($category_id);
        switch ($category_type) {
            case 'Two':
                $query = self::where('CategoryTwoID', $category_id);
                break;
            default:
                $query = self::where('CategoryOneID', $category_id);
                break;
        }
        if ($curr_book_id !== false && is_numeric($curr_book_id)) {
            $query = $query->whereNotIn('ID', [intval($curr_book_id)]);
        }
        $query = $query->paginate(20);
        return is_null($query) ? [] : $query->toArray();
    }

    /**
     * 获取首页的热门推荐书籍
     * @return array
     */
    public static function getHotRecommend() {
        $hot_recommend = Redis::lrange('book:mongodb:hot_recommend', 0, -1);
        $hot_recommend_res = [];
        foreach ($hot_recommend as $item) {
            $hot_recommend_res[] = json_decode($item, true);
        }
        return $hot_recommend_res;
    }

    /**
     * 获取首页的新书推荐信息
     * @return array
     */
    public static function getNewBookRecommend(): array
    {
        $new_book_recommend = Redis::lrange('book:mongodb:new_book_recommend', 0, -1);
        $new_book_recommend_res = [];
        foreach ($new_book_recommend as $item) {
            $new_book_recommend_res[] = json_decode($item, true);
        }
        return $new_book_recommend_res;
    }

    /**
     * 获取分页页码范围算法
     * @param $currentPage
     * @param $totalPages
     * @param $onEachSide
     * @return array
     */
    public static function generatePageRange($currentPage, $totalPages, $onEachSide): array
    {
        // 确保当前页在合法范围内
        $currentPage = max(1, min($totalPages, $currentPage));

        // 计算起始和结束页码
        $startPage = max(1, $currentPage - $onEachSide);
        $endPage = min($totalPages, $currentPage + $onEachSide);

        // 构建页码列表
        $pageRange = range($startPage, $endPage);

        return $pageRange;
    }

    /**
     * 获取首页轮播图信息
     * @return array
     */
    public static function getCarousel() {
        $carousel = Redis::lrange('book:mongodb:index_swiper', 0, -1);
        return is_null($carousel) ? [] : $carousel;
    }

    public static function getSearchListByKeyword($keyword): array
    {
        // book list
        $book = Book::where('Title', 'like', '%' . addslashes($keyword) . '%')->limit(20)->get();
        $book = is_null($book) ? [] : $book->toArray();

        // author
        $author = Author::where('AuthorName', 'like', '%' . addslashes($keyword) . '%')->limit(12)->get();
        $author = is_null($author) ? [] : $author->toArray();

        // press
        $press = Press::where('PressName', 'like', '%' . addslashes($keyword) . '%')->limit(12)->get();
        $press = is_null($press) ? [] : $press->toArray();
        return [
            'book' => $book,
            'author' => $author,
            'press' => $press,
        ];
    }
}
