<?php
/**
 * Class Conf
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka;

use Costalong\Swoft\Kafka\Conf\KafkaConfig;
use Costalong\Swoft\Kafka\Conf\TopicConf;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class Conf
 * @package Costalong\Swoft\Kafka
 * @Bean()
 */
class Conf
{
    /**
     * @var array
     */
    protected $kafkaOptions = [];

    /**
     * @var array
     */
    protected $topicOptions =[];

    /**
     * @return array
     */
    public function getKafkaOptions(): array
    {
        return $this->kafkaOptions;
    }

    /**
     * @param array $kafkaOptions
     */
    public function setKafkaOptions(array $kafkaOptions): void
    {
        $this->kafkaOptions = $kafkaOptions;
    }

    /**
     * @return array
     */
    public function getTopicOptions(): array
    {
        return $this->topicOptions;
    }

    /**
     * @param array $topicOptions
     */
    public function setTopicOptions(array $topicOptions): void
    {
        $this->topicOptions = $topicOptions;
    }


    /**
     * @param string $brokers
     * @return Conf\TopicConf|mixed|\RdKafka\Conf
     * @throws KafkaException
     */
    public function kafkaConfig(string $brokers)
    {
        /** @var KafkaConfig $kafkaConfig */
        $kafkaConfig = BeanFactory::getSingleton(KafkaConfig::class);
        $kafkaConfig->setBrokers($brokers);
        $config = $kafkaConfig->getRdKafkaConf();
        return $kafkaConfig->leadOption($config,$this->getKafkaOptions());
    }

    /**
     * @return TopicConf|mixed|\RdKafka\Conf
     * @throws KafkaException
     */
    public function topicConfig()
    {
        /** @var TopicConf $topicConfig */
        $topicConfig = BeanFactory::getSingleton(TopicConf::class);
        $config = $topicConfig->getKafkaTopicConf();
        return $topicConfig->leadOption($config,$this->getTopicOptions());
    }
}
