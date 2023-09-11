<?php


include './libs/Index.php';

$mall_mysql = new MysqlPdo('mall');


$sql = 'select id from mall_goods';
$ids = $mall_mysql->getRows($sql, 'id');
$ids = array_keys($ids);

foreach ($ids as $id) {
    $update_sql = 'update mall_goods set sales_count = ' . rand(5, 999) . ' where id = ' . $id . ';';
    $mall_mysql->query($update_sql);
}
