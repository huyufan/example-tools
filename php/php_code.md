# php ����ĵ�
##[��Щ����][https://github.com/TIGERB/easy-tips/blob/master/pit.md]

``` php
// php5.6��ʼ�ɵ���@�﷨��php�ϴ�ͼƬ���ݰ汾д��

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
// ���л��뷴���л�

����:
���л����ѱ���(��������)ת���ܴ���ʹ���ı���(����ʧԭ���������Ժͽṹ)
�����л������ַ���ת��ԭ����

������
���л���serialize, json_encode(�������л�����)
�����л���unserialize, json_decode
```

``` php
// static��self������

��һ�ֽ���:
- static: ����ǰ�����õ���
- self: ����ǰ����Ƭ�����ڵ���

�ڶ��ֽ��ͣ�
�������͸��඼��һ����A����������ô
- static: ����õ������A����
- self: ����õ���ǰ���A�����������������self::A()��������õ������A����������ڸ����У�������ø����A������
```