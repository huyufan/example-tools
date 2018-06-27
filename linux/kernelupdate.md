# kernel 升级 

## 查看linux版本  
> more /etc/issue  
> uname -r


## 步骤

1：rpm --import https://www.elrepo.org/RPM-GPG-KEY-elrepo.org

2：cd /etc/yum.repos.d/

3：rpm -ivh http://www.elrepo.org/elrepo-release-6-6.el6.elrepo.noarch.rpm

4：yum --enablerepo=elrepo-kernel install kernel-lt -y

4：修改grub.conf 文件 default值为0   vim /etc/grub.conf


5：重启系统 reboot

6：docket
> curl -sSL -O https://get.docker.com/builds/Linux/x86_64/docker-1.9.1 && chmod +x docker-1.9.1 && mv docker-1.9.1 /usr/local/bin/docker
> $ cp /usr/local/bin/docker /usr/bin/docker
> $ service docker start


7:资料文档[地址一](http://elrepo.org/tiki/tiki-index.php)[地址二](http://www.phpkoo.com/archives/305)

