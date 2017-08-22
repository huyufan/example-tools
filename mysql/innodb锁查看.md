# 查看死锁
``` php
SELECT
    trx_id AS  `事务ID`,
    trx_state AS `事务状态`,
    trx_requested_lock_id  AS  `事务需要等待的资源`,
    trx_wait_started    AS  `事务开始等待时间`,
    trx_tables_in_use AS `事务使用表`,
    trx_tables_locked AS `事务拥有锁`,
    trx_rows_locked  AS `事务锁定行`,
    trx_rows_modified  AS `事务更改行`,
    trx_mysql_thread_id AS `线程id`,
    trx_query  AS `query sql`
FROM   information_schema.innodb_trx ;
```