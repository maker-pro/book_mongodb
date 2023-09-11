<?php
/**
 * hot_recommend.php
 * User: Joe
 * Date: 2023/8/22
 * Time: 18:51
 */

include './libs/Index.php';

$mysql = new MysqlPdo('test');
$sql = 'select * from book_category;';
$result = $mysql->getRows($sql, 'ID');

$redis = new Redis();
$redis->connect('127.0.0.1', 12224);
$redis->auth('fee4991146565f616c1ca328c41c0bca');


$category_tree = [];
foreach ($result as $id => $item) {
    $category_tree[$id] = [
        'category_name' => $item['CategoryName'],
        'child' => [],
        'parent_id' => $item['ParentID']
    ];
    if ($item['ParentID'] > 0) {
        $category_tree[$item['ParentID']]['child'][] = $id;
    }
}

foreach ($category_tree as $id => $item) {
    $redis->set('book:mongodb:book_category:' . $id, json_encode($item));
}
