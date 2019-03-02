# ²é¿´ËÀËø
``` php
SELECT
    trx_id AS  `ÊÂÎñID`,
    trx_state AS `ÊÂÎñ×´Ì¬`,
    trx_requested_lock_id  AS  `ÊÂÎñÐèÒªµÈ´ýµÄ×ÊÔ´`,
    trx_wait_started    AS  `ÊÂÎñ¿ªÊ¼µÈ´ýÊ±¼ä`,
    trx_tables_in_use AS `ÊÂÎñÊ¹ÓÃ±í`,
    trx_tables_locked AS `ÊÂÎñÓµÓÐËø`,
    trx_rows_locked  AS `ÊÂÎñËø¶¨ÐÐ`,
    trx_rows_modified  AS `ÊÂÎñ¸ü¸ÄÐÐ`,
    trx_mysql_thread_id AS `Ïß³Ìid`,
    trx_query  AS `query sql`
FROM   information_schema.innodb_trx ;
```