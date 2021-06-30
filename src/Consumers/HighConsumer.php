<?php
/**
 * Class HighConsumer
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Consumers;

use Costalong\Swoft\Kafka\Exception\KafkaException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class HighConsumer
 * @package Costalong\Swoft\Kafka
 * @Bean()
 */

class HighConsumer extends BaseConsumer implements ConsumerInterface
{

    /**
     * @var \RdKafka\KafkaConsumer
     */
    protected $consume;

    /**
     * @param \RdKafka\Conf $conf
     * @throws KafkaException
     */
    public function getConsumer(\RdKafka\Conf $conf)
    {
        /** @var ConsumerConf $consumerConf */
        $consumerConf = BeanFactory::getBean(ConsumerConf::class);
        $consumerConf->setTopicName($this->getTopicName());
        $this->consume = $consumerConf->getHighConsumer($conf);
    }

    /**
     *
     * @param \RdKafka\TopicConf $topicConf
     */
    public function getTopicConf(\RdKafka\TopicConf $topicConf)
    {
        if ($this->consume  && $this->getTopicName()){

        }
    }
}
