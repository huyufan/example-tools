<?php
//php subscribe.php
$redis=new Redis();
$redis->connect('192.168.1.14','6379');
echo "订阅\n";
$redis->subscribe(['msg'],'callfn');
function callfn($redis,$channel,$msg){
      print_r([
     'redis'   => $redis,
     'channel' => $channel,
     'msg'     => $msg
   ]);
}