# mysql  �����������

## �޸ı����ݿ⣩��Ĭ���ַ������˷���ֻ���޸�Ĭ���ַ�����ĳ���ֶε��ַ������ܲ���ı䣩

1��alter table student default character set=utf8;

## �޸ı����ݿ⣩���ַ���:���˷������޸ı�������ֶε��ַ�����

1��alter table student convert to character set utf8;


## �޸�Ĭ���ļ������� /etc/my.cnf

>[mysqld]
>character-set-server=utf8
>[client]
>default-character-set=utf8
>[mysql]
>default-character-set=utf8