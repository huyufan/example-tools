# taskset 
>����ͨ��taskset�����޸Ľ��̵ġ�CPU�׺�����

## �÷�
1:�������еĽ���,�ĵ���˵���������������,��CPU#1 #2 #3�����PIDΪ2345�Ľ���:
> taskset -cp 1,2,3 2345

2:ָ��������ĳ��cpu������:
> taskset -c 1 /etc/init.d/mysql start

3:����nginx������,����ͨ������nginx��worker_processes ��worker_cpu_affinity������ȷ���ơ�����:
> worker_processes  3;
> worker_cpu_affinity 0010 0100 1000;
> ����0010 0100 1000������,�ֱ�����2��3��4��cpu���ġ�
> ����nginx��,3���������̾Ϳ��Ը����ø��Ե�CPU�ˡ�
