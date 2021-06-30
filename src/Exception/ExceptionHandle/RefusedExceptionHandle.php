<?php
/**
 * Class RefusedExceptionHandle
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Exception\ExceptionHandle;

use Costalong\Swoft\Kafka\Exception\KafkaException;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class RefusedExceptionHandle
 * @package Costalong\Swoft\Kafka\Exception\ExceptionHandle
 * @Bean()
 */
class RefusedExceptionHandle
{
    /**
     * @param $kafka
     * @param $err
     * @param $reason
     * @throws KafkaException
     */
    public function handle($kafka,$err,$reason)
    {
        if ($kafka instanceof \RdKafka\Producer){
            throw new KafkaException("\RdKafka\Producer 处理错误,错误信息:".$reason,$err);
        }elseif ($kafka instanceof \RdKafka\KafkaConsumer){
            throw new KafkaException("\RdKafka\KafkaConsumer 处理错误,错误信息:".$reason,$err);
        }elseif ($kafka instanceof \RdKafka\Consumer){
            throw new KafkaException("\RdKafka\Consumer 处理错误,错误信息:".$reason,$err);
        }
    }
}
