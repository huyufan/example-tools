# lsof

## lsof 使用

1：查看端口号是否开启

> lsof -i:80

2: 查看pid进程信息

>lsof -p  pid

3:根据pid 找到对应的文件(cd /proc/pid)

- cwd符号链接的是进程运行目录；

- exe符号连接就是执行程序的绝对路径；

- cmdline就是程序运行时输入的命令行命令；

- environ记录了进程运行时的环境变量；

- fd目录下是进程打开或使用的文件的符号连接。