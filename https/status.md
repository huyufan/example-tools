# 概念
**Hypertext Transfer Protocol**, 超文本传输(转移)协议，是客户端和服务端传输文本制定的协议。构建WWW的具体的三项技术如下：
**WWW: world wide web**, 万维网

- HTML: Hypertext Markup Language, 超文本标记语言
- HTTP: Hypertext Transfer Protocol, 超文本传输(转移)协议
- URL: Uniform Resource Locator, 统一资源定位符号 

> URI: Uniform Resource Identitier, 统一资源标示符号，URL是URI的子集

## HTTP Status (#1)
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
