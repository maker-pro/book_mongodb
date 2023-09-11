<?php

namespace App\Model;


use Illuminate\Support\Facades\Redis;

class Category
{
    private static $category_key = 'book:mongodb:book_category:';

    /**
     * 根据分类的 id 获取分类信息
     * @param $category_id
     * @return array|mixed
     */
    public static function getCategoryByID($category_id) {
        $category_string = Redis::get(self::$category_key . $category_id);
        $category_array = json_decode($category_string, true);
        if ($category_array) {
            return $category_array;
        }
        return [];
    }

    /**
     * 分类信息结构化
     * @return array
     */
    public static function getCategoryTree() {
        $category_key_list = Redis::keys(self::$category_key. '*');
        $tmp_category_tree = [];
        foreach ($category_key_list as $key) {
            $category_string = Redis::get($key);
            $category_array = json_decode($category_string, true);
            $category_id = str_replace(self::$category_key, '', $key);
            $tmp_category_tree[$category_id] = $category_array;
        }

        $category_tree = [];
        foreach ($tmp_category_tree as $category_id => $item) {
            if (!empty($item['child'])) {
                $category_tree[$category_id] = ['name' => $item['category_name']];
                foreach ($item['child'] as $child) {
                    $category_tree[$category_id]['child'][$child] = $tmp_category_tree[$child]['category_name'];
                }
            }
        }
        return $category_tree;
    }

    /**
     * 分类导航数组
     * @param $category_id
     * @return array
     */
    public static function getCategoryNavBar($category_id) {
        $category = self::getCategoryByID($category_id);
        $nav_bar = [];
        if ($category) {
            // [$category_id => $category['category_name']];
            if ($category['parent_id'] > 0) {
                $category_one = self::getCategoryByID($category['parent_id']);
                $nav_bar[] = [
                    'category_id' => $category['parent_id'],
                    'category_name' => $category_one['category_name']
                ];
            }
            $nav_bar[] = [
                'category_id' => $category_id,
                'category_name' => $category['category_name']
            ];
        }
        return $nav_bar;
    }
}
