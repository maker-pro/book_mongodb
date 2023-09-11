<?php


include './libs/Index.php';

$mysql = new MysqlPdo('test');

$last_id = 0;

do {
    $sql = 'select ID, Sku, CommentDate, UserName, MembershipLevel, Star, CommentText, AddTime, UpdateTime from book_comment where id > ' . $last_id . ' limit 10000';
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
        $bulk->insert($item);
    }

    $manager->executeBulkWrite('book.comments', $bulk);
} while(true);
