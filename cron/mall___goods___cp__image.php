<?php


include './libs/Index.php';

$mall_mysql = new MysqlPdo('mall');

$sql = 'select * from mall_goods where recommend_image <> "" and id not in (1,2);';
$mall_data = $mall_mysql->getRows($sql, 'id');


$source = '/docker-link/crawler_master/book_images/source/@id@.jpg';

$not_source = '/docker-link/crawler_master/book_images/source/not_image.jpg';

foreach ($mall_data as $item) {
    $sku = str_replace('/upload/image/20230904/', '', str_replace('.jpg', '', $item['recommend_image']));

    $image_source = str_replace('@id@', $sku, $source);

    if (!is_file($image_source)) {
        $image_source = $not_source;
        echo $item['recommend_image'] . PHP_EOL;
        die;
    }

//    $to_destination = '/app/site/store/public' . $item['recommend_image'];
//
//    echo 'source: ' . $image_source . ', to: ' . $to_destination . ' ----> ';
//
//    if (copy($image_source, $to_destination)) {
//        echo 'copy success ' . PHP_EOL;
//    } else {
//        echo 'copy   error ' . PHP_EOL;
//    }
}

