# innobackupex ʹ��

## ��װ percona-xtrabackup

- ʹ�� yum install percona-xtrabackup

- ������[����](https://www.percona.com/downloads/XtraBackup/LATEST/)����rpm��

- �簲װʧ��(rpm -ivh) ��yum install libev  Ȼ��ֱ�� yum install percona-xtrabackup-2.3.2-1.el7.x86_64.rpm

- ������[��ַ1](https://bugs.launchpad.net/percona-xtrabackup/+bug/1526636) [��ַ2](https://github.com/percona/percona-xtrabackup/pull/181)

> yum  install perl perl-devel libaio libaio-devel perl-Time-HiRes perl-DBD-MySQL -y

##ȫ�����ݽű�
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
BACKUPDIR=/dbbak/mysql_data # ���ݵ���Ŀ¼
FULLBACKUPDIR=$BACKUPDIR/full # ȫ�ⱸ�ݵ�Ŀ¼
INCRBACKUPDIR=$BACKUPDIR/incr # �������ݵ�Ŀ¼
KEEP=1 # ��������ȫ�ⱸ��
 
# ��ȡ��ʼʱ��
#############################################################################
# ��ӡ������Ϣ���˳�
#############################################################################
error()
{
    echo "$1" 1>&2
    exit 1
}
 
# ��ʼ����ǰ�����صĲ���
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
 
# ���������Ϣ
echo "----------------------------"
echo
echo "$0: MySQL backup script"
echo "started: `date`"
echo
 
# �������Ŀ¼�������򴴽���Ӧ��ȫ������Ŀ¼
for i in $FULLBACKUPDIR $INCRBACKUPDIR
do
        if [ ! -d $i ]; then
                mkdir -pv $i
        fi
done
 
# ѹ���ϴ�ǰһ��ı���
echo "ѹ��ǰһ��ı��ݣ�scp��Զ������"
cd $BACKUPDIR
tar -zcvf $YESTERDAY.tar.gz ./full/ ./incr/
# scp -P 8022 $YESTERDAY.tar.gz root@192.168.10.46:/data/backup/mysql/
#if [ $? = 0 ]; then
rm -rf $BACKUPDIR/full $BACKUPDIR/incr
echo "��ʼȫ������"
innobackupex --defaults-file=$MYCNF $USEROPTIONS $FULLBACKUPDIR > $TMPFILE 2>&1
#else
#  echo "Զ�̱���ʧ��"
#fi
 
if [ -z "`tail -1 $TMPFILE | grep 'completed OK!'`" ] ; then
 echo "$INNOBACKUPEX failed:"; echo
 echo "---------- ERROR OUTPUT from $INNOBACKUPEX ----------"
# cat $TMPFILE
# rm -f $TMPFILE
 exit 1
fi

# �����ȡ��α��ݵ�Ŀ¼ 
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

##�������ݽű�

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
BACKUPDIR=/dbbak/mysql_data # ���ݵ���Ŀ¼
FULLBACKUPDIR=$BACKUPDIR/full # ȫ�ⱸ�ݵ�Ŀ¼
INCRBACKUPDIR=$BACKUPDIR/incr # �������ݵ�Ŀ¼

#############################################################################
# ��ӡ������Ϣ���˳�
#############################################################################
error()
{
    echo "$1" 1>&2
    exit 1
}
 
# ��ʼ����ǰ�����صĲ���
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
 
# ���������Ϣ
echo "----------------------------"
echo
echo "$0: MySQL backup script"
echo "started: `date`"
echo
 
# �������Ŀ¼�������򴴽���Ӧ��ȫ������Ŀ¼
for i in $FULLBACKUPDIR $INCRBACKUPDIR
do
        if [ ! -d $i ]; then
                mkdir -pv $i
        fi
done
 
# ���������ȫ��Ŀ¼
LATEST_FULL=`find $FULLBACKUPDIR -mindepth 1 -maxdepth 1 -type d -printf "%P\n"`
echo "LATEST_FULL=$LATEST_FULL" 

# ��������ȫ����Ȼ����ִ����������
# �����������ݵ�Ŀ¼
TMPINCRDIR=$INCRBACKUPDIR/$LATEST_FULL
mkdir -p $TMPINCRDIR
BACKTYPE="incr"
# ��ȡ�������������Ŀ¼
LATEST_INCR=`find $TMPINCRDIR -mindepth 1 -maxdepth 1 -type d | sort -nr | head -1`
echo "LATEST_INCR=$LATEST_INCR"
  # ������״��������ݣ���ôbasedir��ѡ��ȫ��Ŀ¼������ѡ�����һ�ε���������Ŀ¼
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

# �����ȡ��α��ݵ�Ŀ¼ 
THISBACKUP=`awk -- "/Backup created in directory/ { split( \\\$0, p, \"'\" ) ; print p[2] }" $TMPFILE`
echo "THISBACKUP=$THISBACKUP"
echo
echo "Databases backed up successfully to: $THISBACKUP"

echo
echo "incremental completed: `date`"
exit 0
```

## Ŀ¼�ṹ

- ����mysql_data��ŵ������ݱ��ݣ�mysql_logs��ŵ��Ǳ��ݵ���־��mysql_script��ŵ���ȫ�����������ݵĽű���



## crontab 
``` sh
0 4 * * 3,6 sh /dbbackup/mysql_script/full.sh > /dev/null 2>&1
0 4 * * 1,2,4,5,7 sh /dbbackup/mysql_script/incr.sh > /dev/null 2>&1
```

- ÿ����������ִ��ȫ��������ʱ���������ݣ�����ʱ������賿4��


## ȫ���ָ�

- ֹͣmysql ����
 - sudo /etc/init.d/mysqld stop  
 
- ɾ��dataĿ¼�µ�����
 - sudo rm �Crf /storage/mysql/data/*  
 
- �༭/etc/my.cnf ����basedir��datadir ����innobackupex: Error: Original data directory '.' is not empty! at /usr/bin/innobackupex line 2163
 - basedir = /usr/local/mysql
 - datadir = /storage/mysql/data  
 
## innobackupex�ָ�
- innobackupex --defaults-file=/etc/my.cnf --apply-log /storage/dump/ --use-memory=3G ��xtrabackup��--prepare�� Ԥ�ָ��������ķ�װ

- innobackupex --defaults-file=/etc/my.cnf --copy-back /storage/dump/ --use-memory=3G  ���ѱ����ļ�������ԭ����Ŀ¼��

##  �޸�Ȩ��

- chown -R mysql:mysql /storage/mysql

##  ����mysqld

-mysqld_safe --defaults-file=/etc/my.cnf 2>&1 > /dev/null &


## ������֤�޸�����

- sudo /usr/local/mysql/bin/mysqld_safe --skip-grant-tables &

- mysql �Curoot �Cp #��¼�޸�����


##  �����ָ�

- ȫ��Ӧ��redo
 - innobackupex --defaults-file=/etc/my.cnf --user=root --password=xxxxxx --apply-log --redo-only /dbbak/full/2018-02-02_10-04-08
  
- �ϲ���������
 - innobackupex --defaults-file=/etc/my.cnf --user=root --password=xxxxxx --apply-log --redo-only /dbbak/full/2018-02-02_10-04-08 --incremental-dir=/dbbak/incr/2018-02-02_10-04-08/2018-02-02_12-44-10  --use-memory=8G

- Ŀ¼����
 - innobackupex --defaults-file=/etc/my.cnf --user=root --password=xxxxxx --copy-back /dbbak/full/2018-02-02_10-04-08 --use-memory=8G 
