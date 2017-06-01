# ����
**Hypertext Transfer Protocol**, ���ı�����(ת��)Э�飬�ǿͻ��˺ͷ���˴����ı��ƶ���Э�顣����WWW�ľ������������£�
**WWW: world wide web**, ��ά��
[**mozilla http�ĵ�**][https://developer.mozilla.org/zh-CN/docs/Web/HTTP/]
- HTML: Hypertext Markup Language, ���ı��������
- HTTP: Hypertext Transfer Protocol, ���ı�����(ת��)Э��
- URL: Uniform Resource Locator, ͳһ��Դ��λ���� 

> URI: Uniform Resource Identitier, ͳһ��Դ��ʾ���ţ�URL��URI���Ӽ�

## HTTP Status 
- 200: ok
- 301: �����ض���
- 302: ��ʱ�ض���
- 303: ��ʱ�ض���Ҫ����get������Դ
- 304: not modified, ���ػ��棬���ض����޹�
- 307: ��ʱ�ض���,�ϸ񲻴�post��get
- 400: ��������
- 401: δͨ��http��֤
- 403: forbidden��δ��Ȩ
- 404: not found����������Դ
- 500: internet server error���������
- 502: bad gateway��fastcgi���ص�����web server������
- 503: service unavailable�����񲻿���
- 504: gateway timeout��fastcgi��Ӧ��ʱ

<h2 id="http_header_fields">HTTP Header Fields</h2>
����ͨ��ͷ��

- Cache-Control:
	- no-cache: ��������ڵĻ���
	- no-store: ������
- Pragma: no-cache, ��ʹ�û��棬http1.1ǰ����ʷ�ֶ�
- Connection:
	- ���Ʋ���ת���������ײ����ֶ�
	- Keep-Alive/Close: �־�����
- Date: ����http���ĵ�����
<p>��������ͷ</p>

- Accept: ���Դ����ý�����ͺ����ȼ�
- Host: Ŀ����������
- Referer: ������ķ����ԭʼ��ԴURI
- User-Agent: ����������û���������
- Cookie: cookie��Ϣ

<p>������Ӧͷ</p>

- Location: �ض����ַ
- Server: ������ķ���web server����Ϣ
- Set-Cookie: Ҫ���õ�cookie��Ϣ
	- NAME: Ҫ���õļ�ֵ��
	- expires: cookie����ʱ��
	- path: ָ������cookie��Ŀ¼
	- domain: ָ������cookie������
	- Secure: ָ��֮��ֻ��https�²ŷ���cookie
	- HostOnly: ָ��֮��javascript�޷���ȡcookie