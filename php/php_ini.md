# php.ini 

## output_buffering(�������)

``` php
for ($i = 0; $i < 10; $i++) {
echo $i . '<br/>';
sleep($i + 1); //
} 
```
����ÿ������ͻ��м�������������ֱ����Ӧ���������ܿ�һ���Կ���������ڵȴ��������ű��������֮ǰ�����������һֱ���ֿհס�������Ϊ��������̫С��php output_bufferingû��д����д���ݵ�˳��echo->php buffer->tcp buffer->browser

![ob_start](https://github.com/huyufan/example-tools/blob/master/php/%E5%9B%BE%E7%89%87/ob_start.png)