# php.ini 

## output_buffering(输出缓存)
`for ($i = 0; $i < 10; $i++) {
echo $i . '<br/>';
sleep($i + 1); //
}`
不是每隔几秒就会有间断性输出，而是直到响应结束，才能看一次性看到输出，在等待服务器脚本处理结束之前，浏览器界面一直保持空白。这是因为，数据量太小，php output_buffering没有写满。写数据的顺序echo->php buffer->tcp buffer->browser