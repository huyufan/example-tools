# innobackupex 使用

## 安装 percona-xtrabackup

- 使用 yum install percona-xtrabackup

- 可以在[官网](https://www.percona.com/downloads/XtraBackup/LATEST/)下载rpm包

- 如安装失败(rpm -ivh) 先yum install libev  然后直接 yum install percona-xtrabackup-2.3.2-1.el7.x86_64.rpm

> yum  install perl perl-devel libaio libaio-devel perl-Time-HiRes perl-DBD-MySQL -y