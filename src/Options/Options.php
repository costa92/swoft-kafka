<?php
/**
 * Class Options
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Options;

use Costalong\Swoft\Kafka\Conf\TopicConf;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class Options
 * @package Costalong\Swoft\Kafka\Options
 * @Bean()
 */
class Options
{
    /**
     * @param $topicConf
     * @param array $options
     * @return TopicConf|mixed|\RdKafka\Conf
     * @throws KafkaException
     */
    public function initOptions($topicConf,array $options = [])
    {
        if ($options){
            if ($topicConf instanceof \RdKafka\TopicConf){
                $topicConf = $this->handleKafkaConf($topicConf,$options);
            }elseif ($topicConf instanceof \RdKafka\Conf){
                $topicConf = $this->handleKafkaConf($topicConf,$options);
            }else{
                throw new KafkaException("kafak config excption:".$topicConf);
            }
        }
        return $topicConf;
    }

    /**
     * @param $conf
     * @param $options
     * @return mixed
     */
    protected function handleKafkaConf( $conf, $options)
    {
        foreach ($options as $key =>$value){
            $conf->set($key,$value);
        }
        return $conf;
    }
}
