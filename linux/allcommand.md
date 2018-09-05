# linux 命令符

## awk

1: 用法 awk  -F: '{print $1,$3,$6}' OFS="\t" /etc/passwd

2： 网址(https://coolshell.cn/articles/9070.html)

3: netstat -ntu | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -nr
