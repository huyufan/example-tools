<?php
$redis= new Redis();
$redis->connect('192.168.1.14','6379');
$ac=$redis->publish('msg','来自胡宇凡的消息');
var_dump($ac);
echo '来自胡宇凡的消息';
$redis->close();
