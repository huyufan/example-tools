<?php
header("Content-type:text/html;charset=utf8");
interface ConsistentHash
{
 //将字符串转为hash值
 public function cHash($str);
 //添加一台服务器到服务器列表中
 public function addServer($server);
 //从服务器删除一台服务器
 public function removeServer($server);
 //在当前的服务器列表中找到合适的服务器存放数据
 public function lookup($key);
}
class MyConsistentHash implements ConsistentHash
{
 public $serverList = array(); //服务器列列表
 public $virtualPos = array(); //虚拟节点的位置
 public $virtualPosNum = 5;  //每个节点对应5个虚节点
 /**
  * 将字符串转换成32位无符号整数hash值
  * @param $str
  * @return int
  */
 public function cHash($str)
 {
     
  $str = md5($str);
  return sprintf('%u', crc32($str));
 }
 /**
  * 在当前的服务器列表中找到合适的服务器存放数据
  * @param $key 键名
  * @return mixed 返回服务器IP地址
  */
 public function lookup($key)
 {
  $point = $this->cHash($key);//落点的hash值
  
  $finalServer = current($this->virtualPos);//先取圆环上最小的一个节点当成结果
  foreach($this->virtualPos as $pos=>$server)
  {
   if($point <= $pos)
   {
    $finalServer = $server;
    break;
   }
  }
  reset($this->virtualPos);//重置圆环的指针为第一个
  return $finalServer;
 }
 /**
  * 添加一台服务器到服务器列表中
  * @param $server 服务器IP地址
  * @return bool
  */
 public function addServer($server)
 {
  if(!isset($this->serverList[$server]))
  {
   for($i=0; $i<$this->virtualPosNum; $i++)
   {
    $pos = $this->cHash($server . '-' . $i);
    $this->virtualPos[$pos] = $server;
    $this->serverList[$server][] = $pos;
   }
   ksort($this->virtualPos,SORT_NUMERIC);
  }
 
  return TRUE;
 }
 /**
  * 移除一台服务器（循环所有的虚节点，删除值为该服务器地址的虚节点）
  * @param $key
  * @return bool
  */
 public function removeServer($key)
 {
  if(isset($this->serverList[$key]))
  {
   //删除对应虚节点
   foreach($this->serverList[$key] as $pos)
   {
    unset($this->virtualPos[$pos]);
   }
   //删除对应服务器
   unset($this->serverList[$key]);
  }
  return TRUE;
 }
}

$hashServer = new MyConsistentHash();
$hashServer->addServer('192.168.1.1');
//$hashServer->addServer('192.168.1.2');
//
//$hashServer->addServer('192.168.1.3');
//$hashServer->addServer('192.168.1.4');
//$hashServer->addServer('192.168.1.5');
//$hashServer->addServer('192.168.1.6');
//$hashServer->addServer('192.168.1.7');
//$hashServer->addServer('192.168.1.8');
//$hashServer->addServer('192.168.1.9');
//$hashServer->addServer('192.168.1.10');
echo "增加十台服务器192.168.1.1~192.168.1.10<br />";
echo "保存 key1 到 server :".$hashServer->lookup('key1') . '<br />';
echo "保存 key2 到 server :".$hashServer->lookup('key2') . '<br />';
echo "保存 key3 到 server :".$hashServer->lookup('key3') . '<br />';
echo "保存 key4 到 server :".$hashServer->lookup('key4') . '<br />';
echo "保存 key5 到 server :".$hashServer->lookup('key5') . '<br />';
echo "保存 key6 到 server :".$hashServer->lookup('key6') . '<br />';
echo "保存 key7 到 server :".$hashServer->lookup('key7') . '<br />';
echo "保存 key8 到 server :".$hashServer->lookup('key8') . '<br />';
echo "保存 key9 到 server :".$hashServer->lookup('key9') . '<br />';
echo "保存 key10 到 server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
die();
echo "移除一台服务器192.168.1.2<br />";
$hashServer->removeServer('192.168.1.2');
echo "保存 key1 到 server :".$hashServer->lookup('key1') . '<br />';
echo "保存 key2 到 server :".$hashServer->lookup('key2') . '<br />';
echo "保存 key3 到 server :".$hashServer->lookup('key3') . '<br />';
echo "保存 key4 到 server :".$hashServer->lookup('key4') . '<br />';
echo "保存 key5 到 server :".$hashServer->lookup('key5') . '<br />';
echo "保存 key6 到 server :".$hashServer->lookup('key6') . '<br />';
echo "保存 key7 到 server :".$hashServer->lookup('key7') . '<br />';
echo "保存 key8 到 server :".$hashServer->lookup('key8') . '<br />';
echo "保存 key9 到 server :".$hashServer->lookup('key9') . '<br />';
echo "保存 key10 到 server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "移除一台服务器192.168.1.6<br />";
$hashServer->removeServer('192.168.1.6');
echo "保存 key1 到 server :".$hashServer->lookup('key1') . '<br />';
echo "保存 key2 到 server :".$hashServer->lookup('key2') . '<br />';
echo "保存 key3 到 server :".$hashServer->lookup('key3') . '<br />';
echo "保存 key4 到 server :".$hashServer->lookup('key4') . '<br />';
echo "保存 key5 到 server :".$hashServer->lookup('key5') . '<br />';
echo "保存 key6 到 server :".$hashServer->lookup('key6') . '<br />';
echo "保存 key7 到 server :".$hashServer->lookup('key7') . '<br />';
echo "保存 key8 到 server :".$hashServer->lookup('key8') . '<br />';
echo "保存 key9 到 server :".$hashServer->lookup('key9') . '<br />';
echo "保存 key10 到 server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "移除一台服务器192.168.1.8<br />";
$hashServer->removeServer('192.168.1.8');
echo "保存 key1 到 server :".$hashServer->lookup('key1') . '<br />';
echo "保存 key2 到 server :".$hashServer->lookup('key2') . '<br />';
echo "保存 key3 到 server :".$hashServer->lookup('key3') . '<br />';
echo "保存 key4 到 server :".$hashServer->lookup('key4') . '<br />';
echo "保存 key5 到 server :".$hashServer->lookup('key5') . '<br />';
echo "保存 key6 到 server :".$hashServer->lookup('key6') . '<br />';
echo "保存 key7 到 server :".$hashServer->lookup('key7') . '<br />';
echo "保存 key8 到 server :".$hashServer->lookup('key8') . '<br />';
echo "保存 key9 到 server :".$hashServer->lookup('key9') . '<br />';
echo "保存 key10 到 server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "移除一台服务器192.168.1.2<br />";
$hashServer->removeServer('192.168.1.2');
echo "保存 key1 到 server :".$hashServer->lookup('key1') . '<br />';
echo "保存 key2 到 server :".$hashServer->lookup('key2') . '<br />';
echo "保存 key3 到 server :".$hashServer->lookup('key3') . '<br />';
echo "保存 key4 到 server :".$hashServer->lookup('key4') . '<br />';
echo "保存 key5 到 server :".$hashServer->lookup('key5') . '<br />';
echo "保存 key6 到 server :".$hashServer->lookup('key6') . '<br />';
echo "保存 key7 到 server :".$hashServer->lookup('key7') . '<br />';
echo "保存 key8 到 server :".$hashServer->lookup('key8') . '<br />';
echo "保存 key9 到 server :".$hashServer->lookup('key9') . '<br />';
echo "保存 key10 到 server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "增加一台服务器192.168.1.11<br />";
$hashServer->addServer('192.168.1.11');
echo "保存 key1 到 server :".$hashServer->lookup('key1') . '<br />';
echo "保存 key2 到 server :".$hashServer->lookup('key2') . '<br />';
echo "保存 key3 到 server :".$hashServer->lookup('key3') . '<br />';
echo "保存 key4 到 server :".$hashServer->lookup('key4') . '<br />';
echo "保存 key5 到 server :".$hashServer->lookup('key5') . '<br />';
echo "保存 key6 到 server :".$hashServer->lookup('key6') . '<br />';
echo "保存 key7 到 server :".$hashServer->lookup('key7') . '<br />';
echo "保存 key8 到 server :".$hashServer->lookup('key8') . '<br />';
echo "保存 key9 到 server :".$hashServer->lookup('key9') . '<br />';
echo "保存 key10 到 server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';