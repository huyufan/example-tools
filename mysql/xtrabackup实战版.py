#!/bin/sh
# add xucl
#���ݽű�
#ȫ�����ݽű�
#�������ݽű�
#ȫ���ָ�
#�����ָ�
     
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