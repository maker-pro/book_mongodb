<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Comment extends Model
{
    protected $collection = 'comments';
    protected $primaryKey = 'ID';

    /**
     * 通过 id 查询作者
     * @param $id
     * @return array
     */
    public static function getCommentBySku($sku) {
        if (empty($sku)) {
            return [];
        }
        $query = self::where('Sku', intval($sku))->orderBy('CommentDate', 'DESC')->get();
        return is_null($query) ? [] : $query->toArray();
    }
}
