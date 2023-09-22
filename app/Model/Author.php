<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Author extends Model
{
    protected $collection = 'author';
    protected $primaryKey = 'ID';

    /**
     * 通过 id 查询作者
     * @param $id
     * @return array
     */
    public static function getAuthorByID($id) {
        if (empty($id)) {
            return [];
        }
        $query = self::where('ID', intval($id))->first();
        return is_null($query) ? [] : $query->toArray();
    }

    /**
     * 通过 name 查询作者
     * @param $author_name
     * @return array
     */
    public static function getAuthorByName($author_name) {
        if (empty($author_name)) {
            return [];
        }
        $query = self::where('AuthorName', addslashes($author_name))->first();
        return is_null($query) ? [] : $query->toArray();
    }

    /**
     * 获取同一作者的其他书籍
     * @param $author_name_string
     * @return array
     */
    public static function getRecommendedBookByAuthor($author_name_string) {
        $author_name_list = explode(',', $author_name_string);
        $author_name_list = array_map(function ($author_name_item) {
            return addslashes($author_name_item);
        }, $author_name_list);

        if (empty($author_name_list)) {
            return [];
        }
        $query = self::whereIn('AuthorName', $author_name_list)->get();
        $author_info_list = is_null($query) ? [] : $query->toArray();

        $book_ids = [];
        foreach ($author_info_list as $author_info_item) {
            foreach (explode(',', $author_info_item['BookIDStr']) as $book_item_id) {
                $book_ids[$book_item_id] = 1;
            }
        }
        if (empty($book_ids)) {
            return [];
        }
        $book_id_str = implode(',', array_keys($book_ids));
        $book_info = Book::getBookByID($book_id_str);
        if (count($book_ids) == 1) {
            $book_info = [$book_info];
        }
        return $book_info;
    }
}
