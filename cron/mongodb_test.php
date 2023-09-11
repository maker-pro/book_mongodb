<?php
/**
 * mongodb_test.php
 * User: Joe
 * Date: 2023/8/24
 * Time: 14:27
 */

include './libs/Index.php';

$manager = new MongoDB\Driver\Manager(MONGODB_CONN);

var_dump($manager);
die;
