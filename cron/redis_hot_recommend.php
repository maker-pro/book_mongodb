<?php
/**
 * hot_recommend.php
 * User: Joe
 * Date: 2023/8/22
 * Time: 18:51
 */

include './libs/Index.php';

$mysql = new MysqlPdo('test');
$sql = 'select ID, Sku, Title, Price, Store, Detail, Star, CategoryOne, CategoryTwo, NewAuthor, ReleaseTime, Press, AddTime, UpdateTime from books limit 1022, 8';
$result = $mysql->getRows($sql, 'ID');

$redis = new Redis();
$redis->connect('127.0.0.1', 12224);
$redis->auth('fee4991146565f616c1ca328c41c0bca');

// 热门推荐
foreach ($result as $item) {
    $redis->lPush('book:mongodb:hot_recommend', json_encode($item));
}


$sql = 'select ID, Sku, Title, Price, Store, Detail, Star, CategoryOne, CategoryTwo, NewAuthor, ReleaseTime, Press, AddTime, UpdateTime from books limit 80, 8';
$result = $mysql->getRows($sql, 'ID');

// 新书推荐
foreach ($result as $item) {
    $redis->lPush('book:mongodb:new_book_recommend', json_encode($item));
}
