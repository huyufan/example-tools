<?php
header("Content-type:text/html;charset=utf8");
interface ConsistentHash
{
 //���ַ���תΪhashֵ
 public function cHash($str);
 //���һ̨���������������б���
 public function addServer($server);
 //�ӷ�����ɾ��һ̨������
 public function removeServer($server);
 //�ڵ�ǰ�ķ������б����ҵ����ʵķ������������
 public function lookup($key);
}
class MyConsistentHash implements ConsistentHash
{
 public $serverList = array(); //���������б�
 public $virtualPos = array(); //����ڵ��λ��
 public $virtualPosNum = 5;  //ÿ���ڵ��Ӧ5����ڵ�
 /**
  * ���ַ���ת����32λ�޷�������hashֵ
  * @param $str
  * @return int
  */
 public function cHash($str)
 {
     
  $str = md5($str);
  return sprintf('%u', crc32($str));
 }
 /**
  * �ڵ�ǰ�ķ������б����ҵ����ʵķ������������
  * @param $key ����
  * @return mixed ���ط�����IP��ַ
  */
 public function lookup($key)
 {
  $point = $this->cHash($key);//����hashֵ
  
  $finalServer = current($this->virtualPos);//��ȡԲ������С��һ���ڵ㵱�ɽ��
  foreach($this->virtualPos as $pos=>$server)
  {
   if($point <= $pos)
   {
    $finalServer = $server;
    break;
   }
  }
  reset($this->virtualPos);//����Բ����ָ��Ϊ��һ��
  return $finalServer;
 }
 /**
  * ���һ̨���������������б���
  * @param $server ������IP��ַ
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
  * �Ƴ�һ̨��������ѭ�����е���ڵ㣬ɾ��ֵΪ�÷�������ַ����ڵ㣩
  * @param $key
  * @return bool
  */
 public function removeServer($key)
 {
  if(isset($this->serverList[$key]))
  {
   //ɾ����Ӧ��ڵ�
   foreach($this->serverList[$key] as $pos)
   {
    unset($this->virtualPos[$pos]);
   }
   //ɾ����Ӧ������
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
echo "����ʮ̨������192.168.1.1~192.168.1.10<br />";
echo "���� key1 �� server :".$hashServer->lookup('key1') . '<br />';
echo "���� key2 �� server :".$hashServer->lookup('key2') . '<br />';
echo "���� key3 �� server :".$hashServer->lookup('key3') . '<br />';
echo "���� key4 �� server :".$hashServer->lookup('key4') . '<br />';
echo "���� key5 �� server :".$hashServer->lookup('key5') . '<br />';
echo "���� key6 �� server :".$hashServer->lookup('key6') . '<br />';
echo "���� key7 �� server :".$hashServer->lookup('key7') . '<br />';
echo "���� key8 �� server :".$hashServer->lookup('key8') . '<br />';
echo "���� key9 �� server :".$hashServer->lookup('key9') . '<br />';
echo "���� key10 �� server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
die();
echo "�Ƴ�һ̨������192.168.1.2<br />";
$hashServer->removeServer('192.168.1.2');
echo "���� key1 �� server :".$hashServer->lookup('key1') . '<br />';
echo "���� key2 �� server :".$hashServer->lookup('key2') . '<br />';
echo "���� key3 �� server :".$hashServer->lookup('key3') . '<br />';
echo "���� key4 �� server :".$hashServer->lookup('key4') . '<br />';
echo "���� key5 �� server :".$hashServer->lookup('key5') . '<br />';
echo "���� key6 �� server :".$hashServer->lookup('key6') . '<br />';
echo "���� key7 �� server :".$hashServer->lookup('key7') . '<br />';
echo "���� key8 �� server :".$hashServer->lookup('key8') . '<br />';
echo "���� key9 �� server :".$hashServer->lookup('key9') . '<br />';
echo "���� key10 �� server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "�Ƴ�һ̨������192.168.1.6<br />";
$hashServer->removeServer('192.168.1.6');
echo "���� key1 �� server :".$hashServer->lookup('key1') . '<br />';
echo "���� key2 �� server :".$hashServer->lookup('key2') . '<br />';
echo "���� key3 �� server :".$hashServer->lookup('key3') . '<br />';
echo "���� key4 �� server :".$hashServer->lookup('key4') . '<br />';
echo "���� key5 �� server :".$hashServer->lookup('key5') . '<br />';
echo "���� key6 �� server :".$hashServer->lookup('key6') . '<br />';
echo "���� key7 �� server :".$hashServer->lookup('key7') . '<br />';
echo "���� key8 �� server :".$hashServer->lookup('key8') . '<br />';
echo "���� key9 �� server :".$hashServer->lookup('key9') . '<br />';
echo "���� key10 �� server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "�Ƴ�һ̨������192.168.1.8<br />";
$hashServer->removeServer('192.168.1.8');
echo "���� key1 �� server :".$hashServer->lookup('key1') . '<br />';
echo "���� key2 �� server :".$hashServer->lookup('key2') . '<br />';
echo "���� key3 �� server :".$hashServer->lookup('key3') . '<br />';
echo "���� key4 �� server :".$hashServer->lookup('key4') . '<br />';
echo "���� key5 �� server :".$hashServer->lookup('key5') . '<br />';
echo "���� key6 �� server :".$hashServer->lookup('key6') . '<br />';
echo "���� key7 �� server :".$hashServer->lookup('key7') . '<br />';
echo "���� key8 �� server :".$hashServer->lookup('key8') . '<br />';
echo "���� key9 �� server :".$hashServer->lookup('key9') . '<br />';
echo "���� key10 �� server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "�Ƴ�һ̨������192.168.1.2<br />";
$hashServer->removeServer('192.168.1.2');
echo "���� key1 �� server :".$hashServer->lookup('key1') . '<br />';
echo "���� key2 �� server :".$hashServer->lookup('key2') . '<br />';
echo "���� key3 �� server :".$hashServer->lookup('key3') . '<br />';
echo "���� key4 �� server :".$hashServer->lookup('key4') . '<br />';
echo "���� key5 �� server :".$hashServer->lookup('key5') . '<br />';
echo "���� key6 �� server :".$hashServer->lookup('key6') . '<br />';
echo "���� key7 �� server :".$hashServer->lookup('key7') . '<br />';
echo "���� key8 �� server :".$hashServer->lookup('key8') . '<br />';
echo "���� key9 �� server :".$hashServer->lookup('key9') . '<br />';
echo "���� key10 �� server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';
echo "����һ̨������192.168.1.11<br />";
$hashServer->addServer('192.168.1.11');
echo "���� key1 �� server :".$hashServer->lookup('key1') . '<br />';
echo "���� key2 �� server :".$hashServer->lookup('key2') . '<br />';
echo "���� key3 �� server :".$hashServer->lookup('key3') . '<br />';
echo "���� key4 �� server :".$hashServer->lookup('key4') . '<br />';
echo "���� key5 �� server :".$hashServer->lookup('key5') . '<br />';
echo "���� key6 �� server :".$hashServer->lookup('key6') . '<br />';
echo "���� key7 �� server :".$hashServer->lookup('key7') . '<br />';
echo "���� key8 �� server :".$hashServer->lookup('key8') . '<br />';
echo "���� key9 �� server :".$hashServer->lookup('key9') . '<br />';
echo "���� key10 �� server :".$hashServer->lookup('key10') . '<br />';
echo '<hr />';