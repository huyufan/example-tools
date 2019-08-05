# Redis [文档](https://segmentfault.com/p/1210000013570431/read)

## 数据类型

* string类型  set get inrc 存 string/int/float

* list类型   lpush  lpop  

* set类型    sadd scard

* hash类型  hset hget(单个) hmget(多个)  

* sort set 类型 zadd

* hyperloglog(基数统计) PFADD mykey “redis”  PFCOUNT mykey 

* geo(3.2版本)

× bitmaps(二进制) 512M  SETBIT key offset value (用户签到 统计活跃用户 用户在线状态)

## reids 用法
1: Redis Sentinal着眼于高可用，在master宕机时会自动将slave提升为master，继续提供服务。

2: Redis Cluster着眼于扩展性，在单个redis内存不足时，使用Cluster进行分片存储


## reids 持久化
> bgsave做镜像全量持久化，aof做增量持久化。因为bgsave会耗费较长时间，不够实时，在停机的时候会导致大量丢失数据，所以需要aof来配合使用。在redis实例重启时，会使用bgsave持久化文件重新构建内存，再使用aof重放近期的操作指令来实现完整恢复重启之前的状态。

> 对方追问那如果突然机器掉电会怎样？取决于aof日志sync属性的配置，如果不要求性能，在每条写指令时都sync一下磁盘，就不会丢失数据。但是在高性能的要求下每次都sync是不现实的，一般都使用定时sync，比如1s1次，这个时候最多就会丢失1s的数据。

对方追问bgsave的原理是什么？你给出两个词汇就可以了，fork和cow。fork是指redis通过创建子进程来进行bgsave操作，cow指的是copy on write，子进程创建后，父子进程共享数据段，父进程继续提供读写服务，写脏的页面数据会逐渐和子进程分离开来

批量删除
redis-cli -h  keys app_user:user_limit_* | xargs redis-cli -h  del
