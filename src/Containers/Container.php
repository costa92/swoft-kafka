<?php
/**
 * Class Container
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Containers;

use Costalong\Swoft\Kafka\Exception\KafkaException;
use Costalong\Swoft\Kafka\Handle\HandleInterface;
use Costalong\Swoft\Kafka\Handle\KafkaConsumer\AssignPartitionsHandle;
use Costalong\Swoft\Kafka\Handle\KafkaConsumer\PartitionsInterface;
use Costalong\Swoft\Kafka\Handle\KafkaConsumer\RevokePartitionsHandle;
use Costalong\Swoft\Kafka\Handle\NormalHandle;
use Costalong\Swoft\Kafka\Handle\PartitionHandle;
use Costalong\Swoft\Kafka\Handle\TimeoutHandle;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class Container
 * @package Costalong\Swoft\Kafka\Containers
 * @Bean()
 */

class Container
{
    /**
     * 处理结果
     * @param \RdKafka\Message $message
     * @param callable $func
     * @return mixed
     * @throws KafkaException
     */
    public function handleResult(\RdKafka\Message $message,callable $func)
    {
        $handleClass = [
            RD_KAFKA_RESP_ERR_NO_ERROR => NormalHandle::class,
            RD_KAFKA_RESP_ERR__PARTITION_EOF => PartitionHandle::class,
            RD_KAFKA_RESP_ERR__TIMED_OUT => TimeoutHandle::class
        ];
        // 处理数据
        if (array_key_exists($message->err,$handleClass)){
            /** @var HandleInterface $newHandleClass */
            $newHandleClass = new $handleClass[$message->err];
            return $newHandleClass->handle($message,$func);
        }
        throw new KafkaException($message->errstr(), $message->err);
    }


    /**
     * @param \RdKafKa\KafkaConsumer $kafka
     * @param $err
     * @param array|null $partitions
     * @throws KafkaException
     */
    public function handleRebalanceCb(\RdKafKa\KafkaConsumer $kafka,$err, array $partitions = null)
    {
        $handleClass = [
            RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS => AssignPartitionsHandle::class,
            RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS => RevokePartitionsHandle::class,
        ];
        if (array_key_exists($err,$handleClass)){
            /** @var PartitionsInterface $newHandleClass */
            $newHandleClass = new $handleClass[$err];
            $newHandleClass->handlePartition($kafka,$err,$partitions);
        }else{
            throw new KafkaException($err);
        }
    }

    /**
     * @param int $code
     * @param callable $func
     * @return mixed
     * @throws KafkaException
     */
    public function  handleResultProducer(int $code,callable $func)
    {
        $handleClass = [
            RD_KAFKA_RESP_ERR_NO_ERROR => NormalHandle::class,
            RD_KAFKA_RESP_ERR__PARTITION_EOF => PartitionHandle::class,
            RD_KAFKA_RESP_ERR__TIMED_OUT => TimeoutHandle::class
        ];
        // 处理数据
        if (array_key_exists($code,$handleClass)){
            /** @var HandleInterface $newHandleClass */
            $newHandleClass = new $handleClass[$code];
            return $newHandleClass->handleByCode($code,$func);
        }else{
            throw new KafkaException(rd_kafka_err2str($code),$code);
        }
    }
}


