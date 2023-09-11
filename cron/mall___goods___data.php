<?php


include './libs/Index.php';

$mall_mysql = new MysqlPdo('mall');
$test_mysql = new MysqlPdo('test');

$three_category = [
    "207" => "1,49,207",
    "264" => "1,49,264",
    "296" => "1,49,296",
    "403" => "2,50,403",
    "440" => "4,52,440",
    "463" => "4,52,463",
    "200" => "1,53,200",
    "375" => "1,53,375",
    "120" => "5,54,120",
    "130" => "5,54,130",
    "137" => "5,54,137",
    "173" => "5,54,173",
    "194" => "5,54,194",
    "295" => "5,54,295",
    "210" => "9,58,210",
    "116" => "10,59,116",
    "342" => "10,60,342",
    "84" => "5,61,84",
    "180" => "5,61,180",
    "183" => "5,61,183",
    "184" => "5,61,184",
    "253" => "5,61,253",
    "303" => "5,61,303",
    "311" => "5,61,311",
    "367" => "5,61,367",
    "226" => "9,63,226",
    "245" => "9,63,245",
    "447" => "9,63,447",
    "91" => "5,65,91",
    "223" => "5,65,223",
    "413" => "5,65,413",
    "179" => "10,68,179",
    "261" => "10,68,261",
    "457" => "10,68,457",
    "109" => "1,74,109",
    "333" => "1,74,333",
    "162" => "2,121,162",
    "446" => "2,121,446",
    "508" => "2,121,508",
    "346" => "2,132,346",
    "479" => "2,132,479",
    "490" => "2,132,490",
    "507" => "2,132,507",
    "270" => "9,150,270",
    "315" => "9,150,315",
    "332" => "9,150,332",
    "516" => "4,236,516",
    "620" => "4,345,620",
    "712" => "4,345,712"
];
$specs_list = [
    '1' => [
        'name' => '类型',
        'value_list' => [
            ['specs_id' => 27, 'specs_value_name' => '典藏版', 'price_float' => 1.8],
            ['specs_id' => 28, 'specs_value_name' => '周年版', 'price_float' => 1.2],
            ['specs_id' => 29, 'specs_value_name' => '纪念版', 'price_float' => 1.5],
            ['specs_id' => 30, 'specs_value_name' => '普通版', 'price_float' => 1],
        ]
    ],
    '2' => [
        'name' => '封皮',
        'value_list' => [
            ['specs_id' => 31, 'specs_value_name' => '真皮封皮', 'price_float' => 1.7],
            ['specs_id' => 32, 'specs_value_name' => '加厚封皮', 'price_float' => 1.4],
            ['specs_id' => 33, 'specs_value_name' => '普通封皮', 'price_float' => 1.1],
            ['specs_id' => 34, 'specs_value_name' => '简单封面', 'price_float' => 1],
        ]
    ]
];


$three_category_ids = array_keys($three_category);

$test_sql = 'select * from books where CategoryTwoID in (' . implode(',', $three_category_ids) . ')';
$test_goods = $test_mysql->getRows($test_sql, 'ID');

foreach ($test_goods as $item) {
    $goods_base_price = empty($item['Price']) ? rand(20, 50) : $item['Price'];
    $create_time = (time() - rand(15768000, 31536000));
    $update_time = (time() - rand(15768000, 31536000) + 3600 * 24 * rand(1, 10));

    PrintLog('...开启事务...');
    $mall_mysql->startTransaction();
    try {
        $tmp_carousel_image_list = [];
        $tmp_big_image = '/upload/image/20230904/' . $item['Sku'] . '.jpg';
        $tmp_carousel_num_limit = rand(2, 3);
        for ($i_ = 0; $i_ <= $tmp_carousel_num_limit; $i_++) {
            $tmp_carousel_image_list[] = $tmp_big_image;
        }
        $tmp_carousel_image = implode(',', $tmp_carousel_image_list);

        // goods
        $insert_array = [
            'title' => trim($item['Title']),
            'category_id' => $item['CategoryTwoID'],
            'category_path_id' => $three_category[$item['CategoryTwoID']],
            'promotion_title' => trim($item['Title']),
            'goods_unit' => '本',
            'keywords' => '',
            'sub_title' => mb_substr(trim($item['Title']), 0, 80, 'utf-8'),
            'stock' => 0,
            'price' => 0,
            'cost_price' => 0,
            'is_show_stock' => '1',
            'description' => '',
            'production_time' => date('Y-m-d', time() - rand(31536000, 31536000 * 2)),
            'big_image' => $tmp_big_image,
            'carousel_image' => $tmp_carousel_image,
            'create_time' => $create_time,
            'update_time' => $update_time,
            'status' => '1',
            'listorder' => rand(0, 999),
        ];
        $mall_insert_goods_sql = formantInsertSql('mall_goods', $insert_array);
        $insert_goods_flag = $mall_mysql->query($mall_insert_goods_sql);
        $goods_id = $mall_mysql->getLastInsertId();
        if (!$insert_goods_flag) {
            throw new Exception('goods 插入失败');
        }

        PrintLog("\n\tGoods详情:\n\t\tTitle: {$insert_array['title']}\n\t\tcategory_id: {$insert_array['category_id']}\n\t\tgoods_id: {$goods_id}");

        // goods_sku
        $goods_specs_type = 1;
        $rand_number = rand(0, 99);
        if ($rand_number <= 40) {
            $goods_specs_type = 1;
        } else {
            $goods_specs_type = 2;
        }

        $insert_sku_array = [];
        if ($goods_specs_type == 1) {
            // 单规格
            PrintLog("\n\t规格: 单规格.");

            $insert_sku_item = [
                'goods_id' => $goods_id,
                'specs_value_ids' => 0,
                'price' => $goods_base_price,
                'cost_price' => ($goods_base_price + rand(10, 50)),
                'stock' => rand(100, 1000),
                'status' => '1',
                'create_time' => $create_time,
                'update_time' => $update_time,
            ];
            $insert_sku_array[] = $insert_sku_item;
        } else {
            // 多规格
            if (rand(0, 99) >= 60) { // 有两个类型
                $tmp_1_limit_number = rand(0, 3);
                $tmp_2_limit_number = rand(0, 3);
                for ($i = 0; $i <= $tmp_1_limit_number; $i++) {
                    $tmp_1_specs_value = $specs_list['1']['value_list'][$i];
                    for ($j = 0; $j <= $tmp_2_limit_number; $j++) {
                        $tmp_2_specs_value = $specs_list['2']['value_list'][$j];

                        $specs_value_ids = $tmp_1_specs_value['specs_id'] . ',' . $tmp_2_specs_value['specs_id'];
                        $price = max([$tmp_1_specs_value['price_float'], $tmp_2_specs_value['price_float']]) * $goods_base_price;

                        $insert_sku_item = [
                            'goods_id' => $goods_id,
                            'specs_value_ids' => $specs_value_ids,
                            'price' => $price,
                            'cost_price' => ($price + rand(10, 50)),
                            'stock' => rand(5, 1000),
                            'status' => '1',
                            'create_time' => $create_time,
                            'update_time' => $update_time,
                        ];
                        $insert_sku_array[] = $insert_sku_item;
                    }
                }

                PrintLog("\n\t规格: 多规格-两个类型, (" . count($insert_sku_array) . ").");

            } else {  // 有一个类型
                $type = (time() % 2 + 1);
                $specs_list_tmp_arr = $specs_list[$type];

                $tmp_limit_number = rand(0, 3);
                for ($i = 0; $i <= $tmp_limit_number; $i++) {
                    $specs_value = $specs_list[$type]['value_list'][$i];
                    $price_float = $specs_value['price_float'];

                    $price = $goods_base_price * $price_float;
                    $specs_value_ids = $specs_value['specs_id'];

                    $insert_sku_item = [
                        'goods_id' => $goods_id,
                        'specs_value_ids' => $specs_value_ids,
                        'price' => $price,
                        'cost_price' => ($price + rand(10, 50)),
                        'stock' => rand(5, 1000),
                        'status' => '1',
                        'create_time' => $create_time,
                        'update_time' => $update_time,
                    ];
                    $insert_sku_array[] = $insert_sku_item;
                }

                PrintLog("\n\t规格: 多规格-一个类型, (" . count($insert_sku_array) . ").");
            }
        }


        // 写入数据
        $is_first = true;
        $update_goods_data = [];
        $tmp_total_goods_stock = 0;
        foreach ($insert_sku_array as $insert_sku_data) {
            $tmp_total_goods_stock += $insert_sku_data['stock'];

            $insert_goods_sku_sql = formantInsertSql('mall_goods_sku', $insert_sku_data);
            $insert_goods_sku_flag = $mall_mysql->query($insert_goods_sku_sql);
            if (!$insert_goods_sku_flag) {
                throw new Exception('goods sku 插入失败');
            }

            PrintLog("\tGoods Sku详情:\n\t\tspecs_value_ids: {$insert_sku_data['specs_value_ids']}\n\t\tprice: {$insert_sku_data['price']}\n\t\tcost_price: {$insert_sku_data['cost_price']}\n\t\tstock: {$insert_sku_data['stock']}\n\t\tgoods_id: {$goods_id}");

            // 回头更新 mall_goods 表
            if ($is_first) {
                $last_goods_sku_id = $mall_mysql->getLastInsertId();
                $update_goods_data = [
                    'price' => $insert_sku_data['price'],
                    'cost_price' => $insert_sku_data['cost_price'],
                    'stock' => 0,
                    'sku_id' => $last_goods_sku_id,
                    'goods_specs_type' => $goods_specs_type,
                    'goods_id' => $insert_sku_data['goods_id']
                ];
                $is_first = false;
            }
        }

        if ($update_goods_data) {
            $update_goods_data['stock'] = $tmp_total_goods_stock;
            $goods_id = $update_goods_data['goods_id'];
            unset($update_goods_data['goods_id']);
            $update_goods_sql = formantUpdateSql('mall_goods', $update_goods_data, $goods_id);
            $update_goods_flag = $mall_mysql->query($update_goods_sql);
            if (!$update_goods_flag) {
                throw new Exception('goods 更新失败');
            }

            PrintLog("\n\t更新 Goods 详情:\n\t\tstock: {$update_goods_data['stock']}\n\t\tsku_id: {$update_goods_data['sku_id']}\n\t\tgoods_specs_type: {$update_goods_data['goods_specs_type']}\n\t\tgoods_id: {$goods_id}");
        }
        $mall_mysql->commitTransaction();
        PrintLog("\n...事务提交...\n");
    } catch (\Exception $e) {
        $mall_mysql->rollbackTransaction();
        PrintLog("...中断错误: " . $e->getMessage());
        PrintLog("...事务回滚...\n");
    }
}

function formantInsertSql($table, $data) {
    $field = '`' . implode('`,`', array_keys($data)) . '`';
    $value = '"' . implode('", "', array_map('addslashes', array_values($data))) . '"';
    $sql = "insert into `{$table}` ({$field}) values ({$value})";
    return $sql;
}

function formantUpdateSql($table, $data, $id) {
    $set_arr = [];
    foreach ($data as $key => $value) {
        $value = $data[$key];
        $set_arr[] = "`{$key}` = '" . addslashes($value) . "'";
    }
    $set_string = implode(', ', $set_arr);
    $sql = "update `{$table}` set {$set_string} where id = {$id}";
    return $sql;
}

function PrintLog($message = '') {
    echo $message . PHP_EOL;
}


