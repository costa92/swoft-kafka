<?php
/**
 * Class Producer
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Producers;

use Costalong\Swoft\Kafka\Common;
use Costalong\Swoft\Kafka\Containers\Container;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Exception;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class Producer
 * @package Costalong\Swoft\Kafka
 * @Bean()
 */
class Producer extends Common
{
    /**
     * @var array
     */
    protected $message = [];
    /**
     * @var int
     */
    private $partitions = RD_KAFKA_PARTITION_UA;


    /**
     * @var \RdKafka\Producer
     */
    protected $producer;


    /**
     * @var \RdKafka\Topic
     */
    protected $topic = null;

    /**
     * @return \RdKafka\Topic
     */
    public function getTopic(): ?\RdKafka\Topic
    {
        return $this->topic;
    }

    /**
     * @param \RdKafka\Topic $topic
     */
    public function setTopic(?\RdKafka\Topic $topic): void
    {
        $this->topic = $topic;
    }



    /**
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }

    /**
     * @param array $message
     */
    public function setMessage(array $message): void
    {
        $this->message = $message;
    }

    /**
     * @param int $partitions
     */
    public function setPartitions(int $partitions): void
    {
        $this->partitions = $partitions;
    }

    /**
     * @return int
     */
    public function getPartitions(): int
    {
        return $this->partitions;
    }

    /**
     * @param \RdKafka\Conf $config
     * @return \RdKafka\Producer
     */
    public function getProducer(\RdKafka\Conf $config): \RdKafka\Producer
    {
        /** @var ProducerConf $producerConf */
        $producerConf= BeanFactory::getBean(ProducerConf::class);
        $producerConf->setKafkaConfig($config);
        $this->producer = $producerConf->getProducer();
        return  $this->producer;
    }


    /**
     * @param \RdKafka\TopicConf $topicConf
     */
    public function getTopicConf(\RdKafka\TopicConf $topicConf)
    {
        if ($this->producer  && $this->getTopicName()){
            $this->topic = $this->producer->newTopic($this->getTopicName(),$topicConf);
        }
    }



    /**
     * @param $partition
     * @param int $msgflags
     * @param string $message
     * @param string|null $key
     * @param string|null $opaque
     * @return false|mixed
     * @throws Exception
     */
    public function pushMessage($partition = RD_KAFKA_PARTITION_UA, int $msgflags  = 0,string $message,string $key = null,string $opaque = NULL )
    {
        if ($this->topic && $message){
            if (getRdKafkaVersion() > "5.0.0"){   // rdkafka 5.0.0 生效
                return $this->topic->produce($partition,$msgflags,$message,$key,$opaque);
            }
            return $this->topic->produce($partition,$msgflags,$message,$key);
        }
        return false;
    }


    /**
     *  发送数据
     * @throws Exception
     */
    public function send($poll = 0, $flushTime = 50)
    {
        $producer = $this->producer;
        $data = json_encode($this->getMessage());
        $this->pushMessage($this->getPartitions(),RD_KAFKA_MSG_F_BLOCK ,$data);
        $producer->poll($poll);

        /** @var Container $container */
        $container = BeanFactory::getSingleton(Container::class);
        if ($producer->getOutQLen() > 0){
            $result = $producer->flush($flushTime);
            if ($result !== RD_KAFKA_RESP_ERR_NO_ERROR ){
                $container->handleResultProducer($result,function () use($result){
                    $msg = rd_kafka_err2str($result);
                    throw new KafkaException($msg,$result);
                });
            }
        }
    }
}
