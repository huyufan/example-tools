# php.ini 

## output_buffering(输出缓存)

``` php
for ($i = 0; $i < 10; $i++) {
echo $i . '<br/>';
sleep($i + 1); //
} 
```
不是每隔几秒就会有间断性输出，而是直到响应结束，才能看一次性看到输出，在等待服务器脚本处理结束之前，浏览器界面一直保持空白。这是因为，数据量太小，php output_buffering没有写满。写数据的顺序echo->php buffer->tcp buffer->browser

## (gzip)
1. 在php.ini中设置output_handler = ob_gzhandler
2. ob_start(ob_gzhandler)
![ob_start](https://github.com/huyufan/example-tools/blob/master/php/%E5%9B%BE%E7%89%87/ob_start.png)

``` php
< ?php if(extension_loaded('zlib')) {ob_start('ob_gzhandler');} header("Content-type: text/html"); ?>
< ?php if(extension_loaded('zlib')) {ob_end_flush();} ?>
```
3. zlib.output_compression(php.ini中)
	- zlib.output_compression = On
	- zlib.output_compression_level = 6 
