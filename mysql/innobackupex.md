# innobackupex 使用

## 安装 percona-xtrabackup

- 使用 yum install percona-xtrabackup

- 可以在[官网](https://www.percona.com/downloads/XtraBackup/LATEST/)下载rpm包

- 如安装失败(rpm -ivh) 先yum install libev  然后直接 yum install percona-xtrabackup-2.3.2-1.el7.x86_64.rpm

- 错误解决[地址1](https://bugs.launchpad.net/percona-xtrabackup/+bug/1526636) [地址2](https://github.com/percona/percona-xtrabackup/pull/181)

> yum  install perl perl-devel libaio libaio-devel perl-Time-HiRes perl-DBD-MySQL -y

##全量备份脚本
```python
#!/bin/sh
# add xucl
     
INNOBACKUPEX=innobackupex
INNOBACKUPEXFULL=/usr/bin/$INNOBACKUPEX
TODAY=`date +%Y%m%d%H%M`
YESTERDAY=`date -d"yesterday" +%Y%m%d%H%M`
USEROPTIONS="--user=root --password=123456"
TMPFILE="/dbbak/mysql_logs/innobackup_$TODAY.$$.tmp" 
MYCNF=/etc/my.cnf
MYSQL=/usr/local/mysql/bin/mysql
MYSQLADMIN=/usr/local/mysql/bin/mysqladmin
BACKUPDIR=/dbbak/mysql_data # 备份的主目录
FULLBACKUPDIR=$BACKUPDIR/full # 全库备份的目录
INCRBACKUPDIR=$BACKUPDIR/incr # 增量备份的目录
KEEP=1 # 保留几个全库备份
 
# 获取开始时间
#############################################################################
# 打印错误信息并退出
#############################################################################
error()
{
    echo "$1" 1>&2
    exit 1
}
 
# 开始备份前检查相关的参数
if [ ! -x $INNOBACKUPEXFULL ]; then
  error "$INNOBACKUPEXFULL does not exist."
fi
 
if [ ! -d $BACKUPDIR ]; then
  error "Backup destination folder: $BACKUPDIR does not exist."
fi
 
if [ -z "`$MYSQLADMIN $USEROPTIONS status | grep 'Uptime'`" ] ; then
 error "HALTED: MySQL does not appear to be running."
fi
 
if ! `echo 'exit' | $MYSQL -s $USEROPTIONS` ; then
 error "HALTED: Supplied mysql username or password appears to be incorrect (not copied here for security, see script)."
fi
 
# 输出备份信息
echo "----------------------------"
echo
echo "$0: MySQL backup script"
echo "started: `date`"
echo
 
# 如果备份目录不存在则创建相应的全备增备目录
for i in $FULLBACKUPDIR $INCRBACKUPDIR
do
        if [ ! -d $i ]; then
                mkdir -pv $i
        fi
done
 
# 压缩上传前一天的备份
echo "压缩前一天的备份，scp到远程主机"
cd $BACKUPDIR
tar -zcvf $YESTERDAY.tar.gz ./full/ ./incr/
# scp -P 8022 $YESTERDAY.tar.gz root@192.168.10.46:/data/backup/mysql/
#if [ $? = 0 ]; then
rm -rf $BACKUPDIR/full $BACKUPDIR/incr
echo "开始全量备份"
innobackupex --defaults-file=$MYCNF $USEROPTIONS $FULLBACKUPDIR > $TMPFILE 2>&1
#else
#  echo "远程备份失败"
#fi
 
if [ -z "`tail -1 $TMPFILE | grep 'completed OK!'`" ] ; then
 echo "$INNOBACKUPEX failed:"; echo
 echo "---------- ERROR OUTPUT from $INNOBACKUPEX ----------"
# cat $TMPFILE
# rm -f $TMPFILE
 exit 1
fi

# 这里获取这次备份的目录 
THISBACKUP=`awk -- "/Backup created in directory/ { split( \\\$0, p, \"'\" ) ; print p[2] }" $TMPFILE`
echo "THISBACKUP=$THISBACKUP"
#rm -f $TMPFILE
echo "Databases backed up successfully to: $THISBACKUP"

# Cleanup
echo "delete tar files of 3 days ago"
find $BACKUPDIR/ -mtime +3 -name "*.tar.gz"  -exec rm -rf {} \;
 
echo
echo "completed: `date`"
exit 0

```

##增量备份脚本

``` python
#!/bin/sh
# add xucl
 
INNOBACKUPEX=innobackupex
INNOBACKUPEXFULL=/usr/bin/$INNOBACKUPEX
TODAY=`date +%Y%m%d%H%M`
USEROPTIONS="--user=root --password=123456"
TMPFILE="/dbbak/mysql_logs/incr_$TODAY.$$.tmp"
MYCNF=/etc/my.cnf
MYSQL=/usr/local/mysql/bin/mysql
MYSQLADMIN=/usr/local/mysql/bin/mysqladmin
BACKUPDIR=/dbbak/mysql_data # 备份的主目录
FULLBACKUPDIR=$BACKUPDIR/full # 全库备份的目录
INCRBACKUPDIR=$BACKUPDIR/incr # 增量备份的目录

#############################################################################
# 打印错误信息并退出
#############################################################################
error()
{
    echo "$1" 1>&2
    exit 1
}
 
# 开始备份前检查相关的参数
if [ ! -x $INNOBACKUPEXFULL ]; then
  error "$INNOBACKUPEXFULL does not exist."
fi
 
if [ ! -d $BACKUPDIR ]; then
  error "Backup destination folder: $BACKUPDIR does not exist."
fi
 
if [ -z "`$MYSQLADMIN $USEROPTIONS status | grep 'Uptime'`" ] ; then
 error "HALTED: MySQL does not appear to be running."
fi
 
if ! `echo 'exit' | $MYSQL -s $USEROPTIONS` ; then
 error "HALTED: Supplied mysql username or password appears to be incorrect (not copied here for security, see script)."
fi
 
# 输出备份信息
echo "----------------------------"
echo
echo "$0: MySQL backup script"
echo "started: `date`"
echo
 
# 如果备份目录不存在则创建相应的全备增备目录
for i in $FULLBACKUPDIR $INCRBACKUPDIR
do
        if [ ! -d $i ]; then
                mkdir -pv $i
        fi
done
 
# 查找最近的全备目录
LATEST_FULL=`find $FULLBACKUPDIR -mindepth 1 -maxdepth 1 -type d -printf "%P\n"`
echo "LATEST_FULL=$LATEST_FULL" 

# 如果最近的全备仍然可用执行增量备份
# 创建增量备份的目录
TMPINCRDIR=$INCRBACKUPDIR/$LATEST_FULL
mkdir -p $TMPINCRDIR
BACKTYPE="incr"
# 获取最近的增量备份目录
LATEST_INCR=`find $TMPINCRDIR -mindepth 1 -maxdepth 1 -type d | sort -nr | head -1`
echo "LATEST_INCR=$LATEST_INCR"
  # 如果是首次增量备份，那么basedir则选择全备目录，否则选择最近一次的增量备份目录
if [ ! $LATEST_INCR ] ; then
  INCRBASEDIR=$FULLBACKUPDIR/$LATEST_FULL
else
  INCRBASEDIR=$LATEST_INCR
fi
echo "Running new incremental backup using $INCRBASEDIR as base."
innobackupex --defaults-file=$MYCNF $USEROPTIONS --incremental $TMPINCRDIR --incremental-basedir $INCRBASEDIR > $TMPFILE 2>&1

 
if [ -z "`tail -1 $TMPFILE | grep 'completed OK!'`" ] ; then
 echo "$INNOBACKUPEX failed:"; echo
 echo "---------- ERROR OUTPUT from $INNOBACKUPEX ----------"
 exit 1
fi

# 这里获取这次备份的目录 
THISBACKUP=`awk -- "/Backup created in directory/ { split( \\\$0, p, \"'\" ) ; print p[2] }" $TMPFILE`
echo "THISBACKUP=$THISBACKUP"
echo
echo "Databases backed up successfully to: $THISBACKUP"

echo
echo "incremental completed: `date`"
exit 0
```

## 目录结构

- 其中mysql_data存放的是数据备份，mysql_logs存放的是备份的日志，mysql_script存放的是全量和增量备份的脚本。



## crontab 
``` sh
0 4 * * 3,6 sh /dbbackup/mysql_script/full.sh > /dev/null 2>&1
0 4 * * 1,2,4,5,7 sh /dbbackup/mysql_script/incr.sh > /dev/null 2>&1
```

- 每周三、周六执行全备，其他时间增量备份，备份时间点在凌晨4点


## 全量恢复

- 停止mysql 服务
 - sudo /etc/init.d/mysqld stop  
 
- 删除data目录下的内容
 - sudo rm –rf /storage/mysql/data/*  
 
- 编辑/etc/my.cnf 加入basedir和datadir 否则innobackupex: Error: Original data directory '.' is not empty! at /usr/bin/innobackupex line 2163
 - basedir = /usr/local/mysql
 - datadir = /storage/mysql/data  
 
## innobackupex恢复
- innobackupex --defaults-file=/etc/my.cnf --apply-log /storage/dump/ --use-memory=3G 对xtrabackup的--prepare（ 预恢复）参数的封装

- innobackupex --defaults-file=/etc/my.cnf --copy-back /storage/dump/ --use-memory=3G  即把备份文件拷贝至原数据目录下

##  修改权限

- chown -R mysql:mysql /storage/mysql

##  启动mysqld

-mysqld_safe --defaults-file=/etc/my.cnf 2>&1 > /dev/null &


## 跳过认证修改密码

- sudo /usr/local/mysql/bin/mysqld_safe --skip-grant-tables &

- mysql –uroot –p #登录修改密码


##  增量恢复

- 全备应用redo
 - innobackupex --defaults-file=/etc/my.cnf --user=root --password=xxxxxx --apply-log --redo-only /dbbak/full/2018-02-02_10-04-08
  
- 合并增量备份
 - innobackupex --defaults-file=/etc/my.cnf --user=root --password=xxxxxx --apply-log --redo-only /dbbak/full/2018-02-02_10-04-08 --incremental-dir=/dbbak/incr/2018-02-02_10-04-08/2018-02-02_12-44-10  --use-memory=8G

- 目录拷贝
 - innobackupex --defaults-file=/etc/my.cnf --user=root --password=xxxxxx --copy-back /dbbak/full/2018-02-02_10-04-08 --use-memory=8G 
