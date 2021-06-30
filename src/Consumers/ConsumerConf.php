<?php
/**
 * Class ConsumerConf
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Consumers;

use Costalong\Swoft\Kafka\Conf;
use Costalong\Swoft\Kafka\Containers\Container;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class ConsumerConf
 * @package Costalong\Swoft\Kafka
 * @Bean()
 */
class ConsumerConf extends Conf
{
    /**
     * @var
     */
    private $topicName;

    /**
     * @var
     */
    private $groupId;

    /**
     * @var int
     */
    private $partition = 0;


    /**
     * @return mixed
     */
    public function getTopicName()
    {
        return $this->topicName;
    }

    /**
     * @param mixed $topicName
     */
    public function setTopicName($topicName): void
    {
        $this->topicName = $topicName;
    }


    /**
     * @return string
     */
    public function getGroupId(): string
    {
        return $this->groupId;
    }

    /**
     * @param string $groupId
     */
    public function setGroupId(string $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return int
     */
    public function getPartition(): int
    {
        return $this->partition;
    }

    /**
     * @param int $partition
     */
    public function setPartition(int $partition): void
    {
        $this->partition = $partition;
    }


    /**
     * @param \RdKafka\Conf $kafkaConf
     * @return \RdKafka\Consumer
     */
    public function getLowConsumer(\RdKafka\Conf $kafkaConf): \RdKafka\Consumer
    {
        return new \RdKafka\Consumer($kafkaConf);
    }

    /**
     * @param \RdKafka\Conf $kafkaConf
     * @return \RdKafka\KafkaConsumer
     * @throws KafkaException
     */
    public function getHighConsumer(\RdKafka\Conf $kafkaConf): \RdKafka\KafkaConsumer
    {
        /** @var  $container Container */
        $container = BeanFactory::getSingleton(Container::class);
        $kafkaConf->setRebalanceCb(function (\RdKafKa\KafkaConsumer $kafka, $err, array $partitions = null) use ($container){
             $container->handleRebalanceCb($kafka,$err,$partitions);
        });
        $consumer = new \RdKafka\KafkaConsumer($kafkaConf);
        $consumer->subscribe([$this->getTopicName()]);

        return $consumer;
    }

}
