# linux ��������
1. �鿴����������� netstat -ant | awk '{++S[$NF]} END {for(s in S)print s,S[s]}'