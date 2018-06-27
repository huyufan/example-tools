# taskset 
>可以通过taskset命令修改进程的“CPU亲和力”

## 用法
1:对运行中的进程,文档上说可以用下面的命令,把CPU#1 #2 #3分配给PID为2345的进程:
> taskset -cp 1,2,3 2345

2:指定进程在某个cpu上运行:
> taskset -c 1 /etc/init.d/mysql start

3:对于nginx服务器,可以通过配置nginx的worker_processes 、worker_cpu_affinity参数精确控制。例如:
> worker_processes  3;
> worker_cpu_affinity 0010 0100 1000;
> 这里0010 0100 1000是掩码,分别代表第2、3、4颗cpu核心。
> 重启nginx后,3个工作进程就可以各自用各自的CPU了。
