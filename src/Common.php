<?php
/**
 * Class Common
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka;

use Costalong\Swoft\Kafka\Consumers\HighConsumer;
use Costalong\Swoft\Kafka\Consumers\LowConsumer;
use Costalong\Swoft\Kafka\Contract\CommonInterface;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Costalong\Swoft\Kafka\Producers\Producer;
use Swoft\Bean\BeanFactory;

/**
 * Class Common
 * @package Costalong\Swoft\Kafka
 *
 */
class Common implements CommonInterface
{
    /**
     * @var Kafka
     */
    protected $kafka;

    /**
     * @var string
     */
    protected $topicName = "";

    /**
     * @var
     */
    protected $groupId = "";

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
     * @return Kafka
     */
    public function getKafka(): Kafka
    {
        return $this->kafka;
    }

    /**
     * @param Kafka $kafka
     */
    public function setKafka(Kafka $kafka): void
    {
        $this->kafka = $kafka;
    }

    /**
     * @return mixed
     */
    public function getGroupId(): string
    {
        return $this->groupId;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId(string $groupId): void
    {
        $this->groupId = $groupId;
    }



    /**
     * @param array $topicArr
     * @param string $client
     * @return void
     * @throws KafkaException
     */
    public function initConf(array $topicArr,string $client)
    {
        /** @var Conf $conf */
        $conf = BeanFactory::getSingleton(Conf::class);
        $brokers = $this->getKafka()->getBrokers();
        if (!empty($topicArr["brokers"])){
            $brokers = $topicArr["brokers"];
        }
        $topic = $topicArr[$client];
        if (!empty($topic["options"])){
            $conf->setKafkaOptions($topic["options"]);
        }

        // kafka 的配置信息
        /** @var \RdKafka\Conf $kafkaConfig */
        $kafkaConfig = $conf->kafkaConfig($brokers);

        if (!empty($topic["topicOptions"])){
            $conf->setTopicOptions($topic["topicOptions"]);
        }
        /** @var \RdKafka\Conf $kafkaConfig */
        $topicConfig = $conf->topicConfig();
        $this->setTopicName($this->getTopicName());
        if ($this instanceof Producer){ // 处理生产的逻辑
            $this->getProducer($kafkaConfig);
            $this->getTopicConf($topicConfig);
        }elseif ($this instanceof LowConsumer || $this instanceof HighConsumer){  // 消费者
            if ($this->getGroupId()){
                $kafkaConfig->set("group.id",$this->getGroupId());
            }
            // 设置处理函数
            if (!empty($topic["handleClass"])){
                $this->setHandleClass($topic["handleClass"]);
            }

            $this->getConsumer($kafkaConfig);
            $this->getTopicConf($topicConfig);

        }
    }
}
