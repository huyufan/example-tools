# mysql sql语句优化查询

## explain

## proflies (是否支持show profiles默认是关闭的)
- show variables like '%profiling%';
- set profiling=1;
- show profiles;
- show profile for query 2;(据query_id 查看某个查询的详细时间耗费)
- show profile block io,cpu for query2; (查看占用cpu、 io)

## straight_join