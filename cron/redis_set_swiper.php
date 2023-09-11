<?php
/**
 * hot_recommend.php
 * User: Joe
 * Date: 2023/8/22
 * Time: 18:51
 */

$redis = new Redis();
$redis->connect('127.0.0.1', 12224);
$redis->auth('fee4991146565f616c1ca328c41c0bca');

$index_swiper = [
    130016, 43994, 80402
];
foreach ($index_swiper as $item) {
    $redis->lPush('book:mongodb:index_swiper', $item);
}
