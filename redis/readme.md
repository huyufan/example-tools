# Redis

## 数据类型

* string类型  set get inrc 存 string/int/float

* list类型   lpush  lpop  

* set类型    sadd scard

* hash类型  hset hget(单个) hmget(多个)  

* sort set 类型 zadd

* hyperloglog(基数统计) PFADD mykey “redis”  PFCOUNT mykey 

* geo(3.2版本)

× bitmaps(二进制) 512M  SETBIT key offset value (用户签到 统计活跃用户 用户在线状态)