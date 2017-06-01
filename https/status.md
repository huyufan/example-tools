# 概念
**Hypertext Transfer Protocol**, 超文本传输(转移)协议，是客户端和服务端传输文本制定的协议。构建WWW的具体的三项技术如下：
**WWW: world wide web**, 万维网
[**mozilla http文档**][https://developer.mozilla.org/zh-CN/docs/Web/HTTP/]
- HTML: Hypertext Markup Language, 超文本标记语言
- HTTP: Hypertext Transfer Protocol, 超文本传输(转移)协议
- URL: Uniform Resource Locator, 统一资源定位符号 

> URI: Uniform Resource Identitier, 统一资源标示符号，URL是URI的子集

## HTTP Status 
- 200: ok
- 301: 永久重定向
- 302: 临时重定向
- 303: 临时重定向，要求用get请求资源
- 304: not modified, 返回缓存，和重定向无关
- 307: 临时重定向,严格不从post到get
- 400: 参数错误
- 401: 未通过http认证
- 403: forbidden，未授权
- 404: not found，不存在资源
- 500: internet server error，代码错误
- 502: bad gateway，fastcgi返回的内容web server不明白
- 503: service unavailable，服务不可用
- 504: gateway timeout，fastcgi响应超时

<h2 id="http_header_fields">HTTP Header Fields</h2>
常见通用头部

- Cache-Control:
	- no-cache: 不缓存过期的缓存
	- no-store: 不缓存
- Pragma: no-cache, 不使用缓存，http1.1前的历史字段
- Connection:
	- 控制不在转发给代理首部不字段
	- Keep-Alive/Close: 持久连接
- Date: 创建http报文的日期
<p>常见请求头</p>

- Accept: 可以处理的媒体类型和优先级
- Host: 目标主机域名
- Referer: 请求从哪发起的原始资源URI
- User-Agent: 创建请求的用户代理名称
- Cookie: cookie信息

<p>常见响应头</p>

- Location: 重定向地址
- Server: 被请求的服务web server的信息
- Set-Cookie: 要设置的cookie信息
	- NAME: 要设置的键值对
	- expires: cookie过期时间
	- path: 指定发送cookie的目录
	- domain: 指定发送cookie的域名
	- Secure: 指定之后只有https下才发送cookie
	- HostOnly: 指定之后javascript无法读取cookie