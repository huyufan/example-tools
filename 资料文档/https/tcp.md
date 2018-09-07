# tcp 详见
[tcp][1]
[1]: http://jm.taobao.org/2017/06/08/20170608/

## linux内核调优tcp_max_syn_backlog和somaxconn的区别
1：/proc/sys/net/ipv4/tcp_max_syn_backlog  tcp_max_syn_backlog是指定所能接受SYN同步包的最大客户端数量，即半连接上限

2：/proc/sys/net/core/somaxconn  somaxconn是指服务端所能accept即处理数据的最大客户端数量，即完成连接上限

## tcp_rmem和tcp_wmem (报错信息TCP: too many of orphaned sockets)

1： cat /proc/sys/net/ipv4/tcp_rmem  单位为byte

2： cat /proc/sys/net/ipv4/tcp_wmem

> 第一个数字表示，当 tcp 使用的 page 少于 196608 时，kernel 不对其进行任何的干预

>  第二个数字表示，当 tcp 使用了超过 262144 的 pages 时，kernel 会进入 “memory pressure” 压力模式

>  第三个数字表示，当 tcp 使用的 pages 超过 393216 时（相当于1.6GB内存），就会报：Out of socket memory