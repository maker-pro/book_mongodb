<?php

include './libs/Index.php';

$mysql = new MysqlPdo('test');

$last_id = 0;

do {
    $sql = 'select ID, Sku, Title, Price, Store, Detail, Star, CategoryOneID, CategoryTwoID, NewAuthor, ReleaseTime, Press, AddTime, UpdateTime from books where id > ' . $last_id . ' limit 10000';
    $result = $mysql->getRows($sql, 'ID');
    if (empty($result)) {
        break;
    } else {
        $last_id = max(array_keys($result));
    }

    echo $last_id . PHP_EOL;

    $manager = new MongoDB\Driver\Manager(MONGODB_CONN);

    // 插入原始数据
    $bulk = new MongoDB\Driver\BulkWrite;

    foreach ($result as $item) {
        $item['ID'] = intval($item['ID']);
        $item['Sku'] = intval($item['Sku']);
        $item['Price'] = intval($item['Price']);
        $item['CategoryOneID'] = intval($item['CategoryOneID']);
        $item['CategoryTwoID'] = intval($item['CategoryTwoID']);
        $bulk->insert($item);
    }

    $manager->executeBulkWrite('book.books', $bulk);

    unset($manager);
} while(true);
