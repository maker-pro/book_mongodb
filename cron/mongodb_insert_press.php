<?php

include './libs/Index.php';

$mysql = new MysqlPdo('test');
$sql = 'select ID, PressName, PressInfo as PressDesc from book_press;';
$result = $mysql->getRows($sql, 'ID');

$manager = new MongoDB\Driver\Manager(MONGODB_CONN);

// 插入原始数据
$bulk = new MongoDB\Driver\BulkWrite;

foreach($result as $item) {
    echo $item['ID'] . PHP_EOL;
	$item['ID'] = intval($item['ID']);
    $item['PressName'] = trim($item['PressName']);
    $item['PressDesc'] = trim($item['PressDesc']);
    $item['BookIDStr'] = getBookID($item['PressName']);
	$bulk->insert($item);
}

$manager->executeBulkWrite('book.press', $bulk);


function getBookID($press_name) {
    global $mysql;
    $sql = 'select ID from books where Press = "' . addslashes($press_name) . '";';
    $result = $mysql->getRows($sql, 'ID');
    return implode(',', array_keys($result));
}
