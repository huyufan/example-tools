# Redis [�ĵ�](https://segmentfault.com/p/1210000013570431/read)

## ��������

* string����  set get inrc �� string/int/float

* list����   lpush  lpop  

* set����    sadd scard

* hash����  hset hget(����) hmget(���)  

* sort set ���� zadd

* hyperloglog(����ͳ��) PFADD mykey ��redis��  PFCOUNT mykey 

* geo(3.2�汾)

�� bitmaps(������) 512M  SETBIT key offset value (�û�ǩ�� ͳ�ƻ�Ծ�û� �û�����״̬)

## reids �÷�
1: Redis Sentinal�����ڸ߿��ã���master崻�ʱ���Զ���slave����Ϊmaster�������ṩ����

2: Redis Cluster��������չ�ԣ��ڵ���redis�ڴ治��ʱ��ʹ��Cluster���з�Ƭ�洢


## reids �־û�
> bgsave������ȫ���־û���aof�������־û�����Ϊbgsave��ķѽϳ�ʱ�䣬����ʵʱ����ͣ����ʱ��ᵼ�´�����ʧ���ݣ�������Ҫaof�����ʹ�á���redisʵ������ʱ����ʹ��bgsave�־û��ļ����¹����ڴ棬��ʹ��aof�طŽ��ڵĲ���ָ����ʵ�������ָ�����֮ǰ��״̬��

> �Է�׷�������ͻȻ���������������ȡ����aof��־sync���Ե����ã������Ҫ�����ܣ���ÿ��дָ��ʱ��syncһ�´��̣��Ͳ��ᶪʧ���ݡ������ڸ����ܵ�Ҫ����ÿ�ζ�sync�ǲ���ʵ�ģ�һ�㶼ʹ�ö�ʱsync������1s1�Σ����ʱ�����ͻᶪʧ1s�����ݡ�

�Է�׷��bgsave��ԭ����ʲô������������ʻ�Ϳ����ˣ�fork��cow��fork��ָredisͨ�������ӽ���������bgsave������cowָ����copy on write���ӽ��̴����󣬸��ӽ��̹������ݶΣ������̼����ṩ��д����д���ҳ�����ݻ��𽥺��ӽ��̷��뿪��