# tcp ���
[tcp][1]
[1]: http://jm.taobao.org/2017/06/08/20170608/

## linux�ں˵���tcp_max_syn_backlog��somaxconn������
1��/proc/sys/net/ipv4/tcp_max_syn_backlog  tcp_max_syn_backlog��ָ�����ܽ���SYNͬ���������ͻ���������������������

2��/proc/sys/net/core/somaxconn  somaxconn��ָ���������accept���������ݵ����ͻ����������������������

## tcp_rmem��tcp_wmem (������ϢTCP: too many of orphaned sockets)

1�� cat /proc/sys/net/ipv4/tcp_rmem  ��λΪbyte

2�� cat /proc/sys/net/ipv4/tcp_wmem

> ��һ�����ֱ�ʾ���� tcp ʹ�õ� page ���� 196608 ʱ��kernel ����������κεĸ�Ԥ

>  �ڶ������ֱ�ʾ���� tcp ʹ���˳��� 262144 �� pages ʱ��kernel ����� ��memory pressure�� ѹ��ģʽ

>  ���������ֱ�ʾ���� tcp ʹ�õ� pages ���� 393216 ʱ���൱��1.6GB�ڴ棩���ͻᱨ��Out of socket memory