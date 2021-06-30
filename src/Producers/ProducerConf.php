<?php
/**
 * Class ProducerConf
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Producers;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class ProducerConf
 * @package Costalong\Swoft\Kafka
 * @Bean()
 */
class ProducerConf
{
    /**
     * @var \RdKafka\Conf
     */
    protected $kafkaConfig;

    /**
     * @return \RdKafka\Conf
     */
    public function getKafkaConfig(): \RdKafka\Conf
    {
        return $this->kafkaConfig;
    }

    /**
     * @param \RdKafka\Conf $kafkaConfig
     */
    public function setKafkaConfig(\RdKafka\Conf $kafkaConfig): void
    {
        $this->kafkaConfig = $kafkaConfig;
    }


    /**
     * @return \RdKafka\Producer
     */
    public function getProducer(): \RdKafka\Producer
    {
        return new \RdKafka\Producer($this->getKafkaConfig());
    }
}
