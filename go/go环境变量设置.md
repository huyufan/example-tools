# GO������������
- GOROOT
	+ golang��װ·����
	
- GOPATH
	+ go�������Ҫ�õ��ģ���go run��go install�� go get�ȡ��������ö��·�����͸���ϵͳ������·������һ����windows�á�;����Linux��mac���á�:���ָ�
	
- GOBIN
	+ go install������·�������������ö��·��������Ϊ�ա�Ϊ��ʱ����ѭ��Լ���������á�ԭ�򣬿�ִ���ļ����ڸ���GOPATHĿ¼��bin�ļ����У�ǰ���ǣ�package main��main�����ļ�����ֱ�ӷŵ�GOPATH��src���档
	
- go�����鿴
	+ ��go env �ɲ鿴��ǰgo����������
	
## GOPATHĿ¼�ṹ
``` php
  goWorkSpace  // (goWorkSpaceΪGOPATHĿ¼)
  -- bin  // golang�����ִ���ļ����·�������Զ����ɡ�
  -- pkg  // golang�����.a�м��ļ����·�������Զ����ɡ�
  -- src  // Դ��·��������golangĬ��Լ����go run��go install������ĵ�ǰ����·�������ڴ�·����ִ�����������		
```  