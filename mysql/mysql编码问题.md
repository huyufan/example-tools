# mysql  解决中文乱码

## 修改表（数据库）的默认字符集（此方法只能修改默认字符集，某个字段的字符集可能不会改变）

1：alter table student default character set=utf8;

## 修改表（数据库）的字符集:（此方法能修改表的所有字段的字符集）

1：alter table student convert to character set utf8;


## 修改默认文件的配置 /etc/my.cnf

>[mysqld]
>character-set-server=utf8
>[client]
>default-character-set=utf8
>[mysql]
>default-character-set=utf8