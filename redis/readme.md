# Redis

## ��������

* string����  set get inrc �� string/int/float

* list����   lpush  lpop  

* set����    sadd scard

* hash����  hset hget(����) hmget(���)  

* sort set ���� zadd

* hyperloglog(����ͳ��) PFADD mykey ��redis��  PFCOUNT mykey 

* geo(3.2�汾)

�� bitmaps(������) 512M  SETBIT key offset value (�û�ǩ�� ͳ�ƻ�Ծ�û� �û�����״̬)