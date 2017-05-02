<?php

$redis = new Redis();
$result = $redis->connect('192.168.1.14', '6379');
$redis->watch('mywatqw');
$mywatchkey = $redis->get('mywatqw');
$count = 231;
if ($mywatchkey < $count) {

    $redis->multi();
    $redis->set("mywatqw", $mywatchkey + 1);
    $rob_result = $redis->exec();
    if ($rob_result) {
        $list = 1;
        $dsn = new PDO("mysql:dbname=test;host=192.168.1.14", 'test', '111111');
        $dsn->beginTransaction();
        $ins = $dsn->prepare('insert into account(sd) value(:sd)');
        $ins->bindParam(":sd", $list);
        $c_list = $ins->execute();
        $dsn->commit();
    }
}

