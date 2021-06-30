<?php
/**
 * Class Topics
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Topic;

use Costalong\Swoft\Kafka\Contract\CommonInterface;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Costalong\Swoft\Kafka\Kafka;
use Costalong\Swoft\Kafka\Producers\Producer;
use Exception;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\BeanFactory;

/**
 * Class Topics
 * @package Costalong\Swoft\Kafka\Topic
 * @Bean()
 */
class Topics
{

    const CLIENT_CONSUMER = "consumer";

    const CLIENT_PRODUCER = "producer";
    /**
     * @Inject()
     * @var Kafka
     */
    protected $kafka;

    /**
     * @var string
     */
    protected $topicName;

    /**
     * @var string
     */
    protected $groupId = "";

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
     * @return string
     */
    public function getTopicName(): string
    {
        return $this->topicName;
    }

    /**
     * @param string $topicName
     */
    public function setTopicName(string $topicName): void
    {
        $this->topicName = $topicName;
    }

    /**
     * @return array
     */
    protected function getTopicsList(): array
    {
        $list =  $this->kafka->getTopics();
        return array_column($list,Null,"name");
    }

    /**
     * @param $name
     * @param string $client
     * @return CommonInterface|false
     * @throws KafkaException
     */
    protected function topicsByName($name, string $client = self::CLIENT_CONSUMER)
    {
        $topics = $this->getTopicsList();
        if (!array_key_exists($name,$topics)){
            throw new KafkaException("消息队列处理错误,缺少topic:".$name);
        }
        $topicArr = $topics[$name];
        // 开始执行消费
        if (!empty($topicArr[$client]["class"])){
            /** @var CommonInterface  $common */
            $common = BeanFactory::getSingleton($topicArr[$client]["class"]);
            $common->setKafka($this->kafka);
            $common->setTopicName($name);
            $common->setGroupId($this->getGroupId());
            $common->initConf($topicArr,$client);
            return $common;
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function consumer()
    {
        if (!$this->getTopicName()){
            throw new KafkaException("topic not set:".$this->getTopicName());
        }
       return $this->topicsByName($this->getTopicName());
    }


    /**
     * @return Producer|false
     * @throws KafkaException
     */
    public function producer()
    {
        if (!$this->getTopicName()){
            throw new KafkaException("topic not set:".$this->getTopicName());
        }
        /** @var Producer $producer */
        return $this->topicsByName($this->getTopicName(),self::CLIENT_PRODUCER);
    }
}
