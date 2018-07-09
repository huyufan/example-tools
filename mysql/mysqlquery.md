# mysql 语法

1: select * from tables for update
> 走的是IX锁(意向排它锁)
>即在符合条件的rows上都加了排它锁，其他session也就无法在这些记录上添加任何的S锁或X锁


2: SELECT ... LOCK IN SHARE MODE
> 走的是IS锁(意向共享锁)
>即在符合条件的rows上都加了共享锁，这样的话，其他session可以读取这些记录，也可以继续添加IS锁，但是无法修改这些记录直到你这个加锁的session执行完成(否则直接锁等待超时)。

3: replace REPLACE INTO users(id, name, age)
> 在使用REPLACE时，表中必须有唯一索引，而且这个索引所在的字段不能允许空值，否则REPLACE就和INSERT完全一样的
> 使用REPLACE的最大好处就是可以将DELETE和INSERT合二为一，形成一个原子操作。这样就可以不必考虑在同时使用DELETE和INSERT时添加事务等复杂操作了

4:INSERT ... ON DUPLICATE KEY UPDATE
> 插入数据时，如果插入的数据中对应的主键或唯一索引的值在表中已存在，则将此条数据对应的字段值修改。如果不存在则直接插入。

