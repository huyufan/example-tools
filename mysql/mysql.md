# 如何优化Linux操作系统用于MySQL环境
一 网络
1.需要根据即使情况考虑，tcp buffer的大小设置，网卡队列大小的设置  连接队列的大小等。 
2.根据实际情况单独设置备份网络，避免备份的时候会影响应用。
二 硬盘
1. 建议使用SSD硬盘，建议使用raid5或者raid10
2. 建议xfs作为文件系统
4. 建议挂在硬盘添加noatime、nodiratime、nobarrier参数。
5. 建议使用合适的磁盘调度算法deadline或noop。
三 CPU
1.建议关闭NUMA
2.建议开启高性能模式
3.如果不关闭NUMA，则建议一个实例绑定到一个Node上
四 内存
1.建议关闭NUMA
2.建议避免使用swap。
3.建议vm.swappiness=1
4.建议开启高性能内存模式
五 其他
1.建议设置最大文件数为65535
2.建议设置用户最大链接数位65535


## dirty ratio
dirty ratio(https://feichashao.com/dirty_ratio_and_dirty_background_ratio)
