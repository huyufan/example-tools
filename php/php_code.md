# php 编程心得
##[有些来自][https://github.com/TIGERB/easy-tips/blob/master/pit.md]

``` php
// php5.6开始干掉了@语法，php上传图片兼容版本写法

if (class_exists('\CURLFile')) {
    curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
    $data = array('file' => new \CURLFile(realpath($destination)));//5.5+
} else {
    if (defined('CURLOPT_SAFE_UPLOAD')) {
        curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
    }
    $data = array('file' => '@' . realpath($destination));//<=5.5
}
```

``` php
// 序列化与反序列化

概念:
序列化：把变量(所有类型)转成能传输和储存的变量(不丢失原变量的属性和结构)
反序列化：把字符串转成原变量

函数：
序列化：serialize, json_encode(不能序列化对象)
反序列化：unserialize, json_decode
```

``` php
// static和self的区别

第一种解释:
- static: 代表当前所引用的类
- self: 代表当前代码片断所在的类

第二种解释：
如果子类和父类都有一个“A”方法。那么
- static: 会调用到子类的A方法
- self: 会调用到当前类的A方法，如果在子类中self::A()，将会调用到子类的A方法，如果在父类中，将会调用父类的A方法。
```