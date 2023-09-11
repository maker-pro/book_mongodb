<?php


include './libs/Index.php';

$mall_mysql = new MysqlPdo('mall');


$sql = 'select id, recommend_image from mall_goods';
$goods_list = $mall_mysql->getRows($sql, 'id');



foreach ($goods_list as $id => $item) {
    $image_num = rand(3, 5);
    $image_list = [];
    for ($i = 1; $i <= $image_num; $i++) {
        if ($i % 2 == 0) {
            $image = '/upload/image/20230904/default.jpg';
        } else {
            $image = $item['recommend_image'];
        }
        $image_list[] = $image;
    }

    $image_list_str = implode(',', $image_list);



    $update_sql = 'update mall_goods set carousel_image = "' . $image_list_str . '" where id = ' . $id . ';' . PHP_EOL;
//    echo $update_sql;
    $mall_mysql->query($update_sql);
}

