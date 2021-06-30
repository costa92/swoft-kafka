<?php
/**
 * Class TopicConf
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Conf;

use Costalong\Swoft\Kafka\Exception\KafkaException;
use Costalong\Swoft\Kafka\Options\Options;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class TopicConf
 * @package Costalong\Swoft\Kafka
 * @Bean()
 */
class TopicConf
{
    /**
     * @return \RdKafka\TopicConf
     */
    public function getTopicConf(): \RdKafka\TopicConf
    {
        return new \RdKafka\TopicConf();
    }

    /**
     * @return \RdKafka\TopicConf
     */
    public function getKafkaTopicConf(): \RdKafka\TopicConf
    {
        return $this->getTopicConf();
    }


    /**
     * @param \RdKafka\TopicConf $conf
     * @param array $KafkaOptions
     * @return TopicConf|mixed|\RdKafka\Conf
     * @throws KafkaException
     */
    public function leadOption(\RdKafka\TopicConf $conf, array $KafkaOptions)
    {
        /** @var Options $options */
        $options = BeanFactory::getSingleton(Options::class);
        return $options->initOptions($conf,$KafkaOptions);
    }
}
