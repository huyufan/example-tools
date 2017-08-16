# 二进制安装
- 从官网下载二进制包如*go1.6.linux-amd64.tar.gz*
- 解压到/usr/local目录(/usr/local/go/bin/go  env)
  + tar -C /usr/local -xzf go$VERSION.$GOOS-$GOARCH.tar.gz
- 设置PATH环境变量，添加/usr/local/go/bin到环境变量
  + export PATH=$PATH:/usr/local/go/bin
- 注意：只有当将go安装到非/usr/local目录时才需要设置GOROOT变量。

