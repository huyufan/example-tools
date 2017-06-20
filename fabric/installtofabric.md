# ǰ��׼��
- yum update yum -y install epel-release yum -y install python-pip
- centos 7.3 �ں˴���3.10 **docker** **docker-compose** **go**
- [�����ĵ�][https://hyperledger-fabric.readthedocs.io/en/latest/getting_started.html] 
- mkdir fabric-sample cd fabric-sample
- curl -sSL https://goo.gl/LQkuoh | bash

## go ��װ
- tar -zxvf go1.8.3.linux-amd64.tar.gz -C /usr/local/
- export GOPATH=/data/golist
- export GOROOT=/usr/local/go
- PATH=$PATH:$GOROOT/BIN

## docker ��װ
- curl -sSL https://get.daocloud.io/docker | sh
- yum install   -y gcc libtool libltdl-dev libtool-ltdl-devel openssl
- go get github.com/golang/protobuf/protoc-gen-go
- url -sSL https://get.daocloud.io/daotools/set_mirror.sh | sh -s http://d4cc5789.m.daocloud.io

# fabric ����
- ./bin/cryptogen generate --config=./crypto-config.yaml

- export FABRIC_CFG_PATH=$PWD

- ./bin/configtxgen -profile TwoOrgsOrdererGenesis -outputBlock ./channel-artifacts/genesis.block

- ./bin/configtxgen -profile TwoOrgsChannel -outputCreateChannelTx ./channel-artifacts/channel.tx -channelID <channel-ID>

- ./bin/configtxgen -profile TwoOrgsChannel -outputAnchorPeersUpdate ./channel-artifacts/Org1MSPanchors.tx -channelID <channel-ID> -asOrg Org1MSP

- ./bin/configtxgen -profile TwoOrgsChannel -outputAnchorPeersUpdate ./channel-artifacts/Org2MSPanchors.tx -channelID <channel-ID> -asOrg Org2MSP



# �������������
> ע��docker-compose-cli.yaml ��57�� ������Ѿ�ע�Ϳ��Ժ��Դ�ע�Ͳ�����
- //command: /bin/bash -c './scripts/script.sh ${CHANNEL_NAME}; sleep $TIMEOUT'

> ������shell��ִ��
- CHANNEL_NAME=king
- ./generateArtifacts.sh $CHANNEL_NAME
> ��������ִ����Ϻ�channel-artifacts�� crypto-config�ڽ����ļ�����

> �������񣬻Ὣ���ɵ��ļ�ӳ�䵽��������ʵ��
- CHANNEL_NAME=$CHANNEL_NAME TIMEOUT=1000 docker-compose -f docker-compose-cli.yaml up -d

> ���ʹ��CouchDB
- CHANNEL_NAME=$CHANNEL_NAME TIMEOUT=1000 docker-compose -f docker-compose-cli.yaml -f docker-compose-couch.yaml up -d
- ��CouchDB������,���������������url��ַ(����http://192.168.1.209:5984/_utils/)
> ִ��֮������
``` shell

[root@host1 linux-amd64]# docker ps
CONTAINER ID        IMAGE                        COMMAND             CREATED             STATUS              PORTS                                              NAMES
4f96d53c21b6        hyperledger/fabric-tools     "/bin/bash"         30 minutes ago      Up 30 minutes                                                          cli
782328887b9d        hyperledger/fabric-peer      "peer node start"   30 minutes ago      Up 30 minutes       0.0.0.0:10051->7051/tcp, 0.0.0.0:10053->7053/tcp   peer1.org2.example.com
46ea947206f1        hyperledger/fabric-orderer   "orderer"           30 minutes ago      Up 30 minutes       0.0.0.0:7050->7050/tcp                             orderer.example.com
f055c5ffa368        hyperledger/fabric-peer      "peer node start"   30 minutes ago      Up 30 minutes       0.0.0.0:7051->7051/tcp, 0.0.0.0:7053->7053/tcp     peer0.org1.example.com
e7cfd965640f        hyperledger/fabric-peer      "peer node start"   30 minutes ago      Up 30 minutes       0.0.0.0:8051->7051/tcp, 0.0.0.0:8053->7053/tcp     peer1.org1.example.com
5d7bcae4e38a        hyperledger/fabric-peer      "peer node start"   30 minutes ago      Up 30 minutes       0.0.0.0:9051->7051/tcp, 0.0.0.0:9053->7053/tcp     peer0.org2.example.com

``` 

# ����Channel������
> �����������ʵ��
- docker exec -it cli bash

## ����������cli����ִ��
> �������
- CHANNEL_NAME=king

> ���ɴ�����
``` shell
- peer channel create -o orderer.example.com:7050 -c $CHANNEL_NAME -f ./channel-artifacts/channel.tx --tls $CORE_PEER_TLS_ENABLED --cafile /opt/gopath/src/github.com/hyperledger/fabric/peer/crypto/ordererOrganizations/example.com/orderers/orderer.example.com/msp/cacerts/ca.example.com-cert.pem
```

> ����
- peer channel join -b $CHANNEL_NAME.block

# ��װCC����ʼ����cli������ִ��

> ��װCC��ֻ�Ǵ�����룬·����������release/linux-amd64/chaincode/go
- peer chaincode install -n mycc -v 1.0 -p github.com/hyperledger/fabric/examples/chaincode/go/chaincode_example02

> ��ʼ����������docker������������ʵ��
``` shell
- $peer chaincode instantiate -o orderer.example.com:7050 --tls $CORE_PEER_TLS_ENABLED --cafile /opt/gopath/src/github.com/hyperledger/fabric/peer/crypto/ordererOrganizations/example.com/orderers/orderer.example.com/msp/cacerts/ca.example.com-cert.pem -C $CHANNEL_NAME -n mycc -v 1.0 -p github.com/hyperledger/fabric/examples/chaincode/go/chaincode_example02 -c '{"Args":["init","a", "100", "b","200"]}' -P "OR ('Org1MSP.member','Org2MSP.member')"
```

> ִ���������dockerʵ��
``` shell
[root@host1 ~]# docker ps
CONTAINER ID        IMAGE                                 COMMAND                  CREATED              STATUS              PORTS                                              NAMES
542cd374810f        dev-peer0.org1.example.com-mycc-1.0   "chaincode -peer.a..."   5 seconds ago        Up 4 seconds                                                           dev-peer0.org1.example.com-mycc-1.0
0e8d5f77cc8c        hyperledger/fabric-tools              "/bin/bash"              About a minute ago   Up About a minute                                                      cli
eac20816bda1        hyperledger/fabric-orderer            "orderer"                About a minute ago   Up About a minute   0.0.0.0:7050->7050/tcp                             orderer.example.com
e57c8f794455        hyperledger/fabric-peer               "peer node start"        About a minute ago   Up About a minute   0.0.0.0:7051->7051/tcp, 0.0.0.0:7053->7053/tcp     peer0.org1.example.com
6d995eeba05d        hyperledger/fabric-peer               "peer node start"        About a minute ago   Up About a minute   0.0.0.0:10051->7051/tcp, 0.0.0.0:10053->7053/tcp   peer1.org2.example.com
4e7873e1ab0b        hyperledger/fabric-peer               "peer node start"        About a minute ago   Up About a minute   0.0.0.0:9051->7051/tcp, 0.0.0.0:9053->7053/tcp     peer0.org2.example.com
a59c5bb01bd8        hyperledger/fabric-peer               "peer node start"        About a minute ago   Up About a minute   0.0.0.0:8051->7051/tcp, 0.0.0.0:8053->7053/tcp     peer1.org1.example.com
``` 

# ��ѯ�͵��ã�cli������ִ��
> ��ѯ
- peer chaincode query -C $CHANNEL_NAME -n mycc -c '{"Args":["query","a"]}'

> ����
``` shell
- peer chaincode invoke -o orderer.example.com:7050  --tls $CORE_PEER_TLS_ENABLED --cafile /opt/gopath/src/github.com/hyperledger/fabric/peer/crypto/ordererOrganizations/example.com/orderers/orderer.example.com/msp/cacerts/ca.example.com-cert.pem  -C $CHANNEL_NAME -n mycc -c '{"Args":["invoke","a","b","10"]}'
```

> ��־�鿴��������ִ��
- docker logs peer0.org1.example.com 

> ��־ʵʱ�鿴��������ִ��
- docker logs -f peer0.org1.example.com 

# �����������ã�������ִ��
> ������������ʵ���������������
``` shell
[root@host1 linux-amd64]# ./network_setup.sh down
``` 

> ����ǰ
``` shell
[root@host1 linux-amd64]# docker images
REPOSITORY                                TAG                 IMAGE ID            CREATED             SIZE
dev-peer0.org1.example.com-mycc-1.0       latest              d9ab7374192d        23 minutes ago      173MB
``` 