<?php
include './libs/Index.php';

$manager = new MongoDB\Driver\Manager(MONGODB_CONN);


function setIndex($database = '', $table = '', $key_name = '', $keys = '', $is_unique = false)
{
	global $manager;
	$command = new MongoDB\Driver\Command([
	    'createIndexes' => $table,
	    'indexes' => [
	        ['key' => $keys, 'name' => $key_name, 'unique' => $is_unique],
	    ],
	]);
	return $manager->executeCommand($database, $command);
}

$res = setIndex('book', 'books', 'id', ['ID' => 1], true);
$res = setIndex('book', 'books', 'sku', ['Sku' => 1], true);
$res = setIndex('book', 'books', 'title', ['Title' => 1]);
$res = setIndex('book', 'books', 'price', ['Price' => 1]);
$res = setIndex('book', 'books', 'store', ['Store' => 1]);
$res = setIndex('book', 'books', 'releasetime', ['ReleaseTime' => 1]);
$res = setIndex('book', 'books', 'categoryoneid', ['CategoryOneID' => 1]);
$res = setIndex('book', 'books', 'categorytwoid', ['CategoryTwoID' => 1]);
