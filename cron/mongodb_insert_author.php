<?php


include './libs/Index.php';

$mysql = new MysqlPdo('test');

$last_id = 0;

do {
    $sql = 'select ID, AuthorName, AuthorDesc from book_author where AuthorDesc is not null and id > ' . $last_id . ' limit 100;';
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
        echo $item['ID'] . PHP_EOL;
        $item['ID'] = intval($item['ID']);
        $item['AuthorName'] = trim($item['AuthorName']);
        $item['AuthorDesc'] = trim($item['AuthorDesc']);
        $item['BookIDStr'] = getBookID($item['AuthorName']);
        $bulk->insert($item);
    }
    $manager->executeBulkWrite('book.author', $bulk);
    unset($manager);
} while(true);

function getBookID($author_name) {
    global $mysql;
    $sql = 'select ID, NewAuthor from books where NewAuthor like "%' . addslashes($author_name) . '%";';
    $result = $mysql->getRows($sql, 'ID');

    $ids = [];
    foreach ($result as $item) {
        if (in_array($author_name, explode(',', $item['NewAuthor']))) {
            $ids[] = $item['ID'];
        }
    }
    return implode(',', $ids);
}
