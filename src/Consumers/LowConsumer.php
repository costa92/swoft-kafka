<?php
/**
 * Class LowConsumer
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Consumers;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class LowConsumer
 * @package Costalong\Swoft\Kafka\Consumers
 * @Bean()
 */
class LowConsumer extends BaseConsumer implements ConsumerInterface
{

    /**
     * @var \RdKafka\Consumer
     */
    protected $consume;

    /**
     * @return \RdKafka\Consumer
     */
    public function getConsume(): \RdKafka\Consumer
    {
        return $this->consume;
    }

    /**
     * @param \RdKafka\Consumer $consume
     */
    public function setConsume(\RdKafka\Consumer $consume): void
    {
        $this->consume = $consume;
    }


    /**
     * @param \RdKafka\Conf $conf
     */
    public function getConsumer(\RdKafka\Conf $conf)
    {
        /** @var ConsumerConf $consumerConf */
        $consumerConf = BeanFactory::getBean(ConsumerConf::class);
        $this->consume = $consumerConf->getLowConsumer($conf);

    }


    /**
     * @param \RdKafka\TopicConf $topicConf
     */
    public function getTopicConf(\RdKafka\TopicConf $topicConf)
    {
        if ($this->consume  && $this->getTopicName()){
            $this->topic = $this->consume->newTopic($this->getTopicName(),$topicConf);
            $this->topic->consumeStart($this->getPartition(), $this->getOffset());
        }

    }
}
