# strace
>strace -p pid                       ����ĳ����̨����
>strace -o                           filename ���ٽ��������ļ�
>strace -T                           ��¼ÿ��ϵͳ���û��ѵ�ʱ��
>strace -c -p pid                    ��¼ʱ�䣬���ô�������������CPU ʱ�ӵ�
>strace -t                           ������ -tt����¼ÿ��ϵͳ���÷����ǵ�ʱ�䣨ʱ����ĸ�ʽ��
>strace -f                           �����ӽ���
>strace -e trace=nanosleep           ֻ��¼��ص�ϵͳ������Ϣ��
>    -e trace=network                ֻ��¼������api��ص�ϵͳ����
>    -e trace=file                   ֻ��¼�漰���ļ�����ϵͳ����
>    -e trace=desc                   ֻ��¼�漰���ļ������ϵͳ����


## php ʵ��
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
## strace �÷�1
1��strace -o debug.log php test.php

2��strace -Tt php test.php
> -T ������ʾÿһ��ϵͳ���û��ѵ�ʱ�䣬-t �����ÿ��ϵͳ���÷�����ʱ�䡣

3: strace -p  29785 -F
> ���� -p ������ʾ���ٽ��� PID �ţ�-F ��ʾ���̸ý��̵��õ��ӽ��̣����� PHP ִ�� exec ���ã������Ƿǳ���Ҫ��һ��������

4: strace -c -o out.log php test.php
> -c �����ܹ�����ϵͳ���õı��棬����ĳ��ϵͳ���õĴ�����ʧ�����ȵȣ�-o �������Խ� strace ������浽 out.log �ļ��С�

5��strace -cp pid ;strace -T -e clone -p <PID> 
> strace���� ����һ�����̵�ϵͳ���û��źŲ��������

6: ltrace ltrace -c /usr/local/php/bin/php test.php
> ���ٽ��̵��ÿ⺯�������