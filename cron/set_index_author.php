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

$res = setIndex('book', 'author', 'id', ['ID' => 1], true);
$res = setIndex('book', 'author', 'name', ['AuthorName' => 1]);




