# strace

## php 实例
``` php

<?php
$file  = "/var/log/data.log";
$fp = fopen($file, "a");
if ($fp) {
    echo "start\n";
    foreach ($log as $v) {
       fwrite($fp, $v."\r\n");
    }
}
fclose($fp);
```
## strace 用法1
1：strace -o debug.log php test.php

2：strace -Tt php test.php
> -T 参数表示每一个系统调用花费的时间，-t 是输出每个系统调用发生的时间。

3: strace -p  29785 -F
> 其中 -p 参数表示跟踪进程 PID 号，-F 表示过程该进程调用的子进程（比如 PHP 执行 exec 调用），这是非常重要的一个参数。

4: strace -c -o out.log php test.php
> -c 参数能够汇总系统调用的报告，比如某个系统调用的次数、失败数等等，-o 参数可以将 strace 输出保存到 out.log 文件中。