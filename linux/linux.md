# linux 常用命令
1. 查看网络连接情况 netstat -ant | awk '{++S[$NF]} END {for(s in S)print s,S[s]}'