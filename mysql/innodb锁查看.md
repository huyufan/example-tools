# �鿴����
``` php
SELECT
    trx_id AS  `����ID`,
    trx_state AS `����״̬`,
    trx_requested_lock_id  AS  `������Ҫ�ȴ�����Դ`,
    trx_wait_started    AS  `����ʼ�ȴ�ʱ��`,
    trx_tables_in_use AS `����ʹ�ñ�`,
    trx_tables_locked AS `����ӵ����`,
    trx_rows_locked  AS `����������`,
    trx_rows_modified  AS `���������`,
    trx_mysql_thread_id AS `�߳�id`,
    trx_query  AS `query sql`
FROM   information_schema.innodb_trx ;
```