<?php
/**
 * Class PartitionsInterface
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Handle\KafkaConsumer;

/**
 * Interface PartitionsInterface
 * @package Costalong\Swoft\Kafka\Handle\KafkaConsumer
 */
interface PartitionsInterface
{
    /**
     * @param \RdKafKa\KafkaConsumer $kafka
     * @param $err
     * @param array|null $partitions
     * @return mixed
     */
    public function handlePartition(\RdKafKa\KafkaConsumer $kafka, $err, array $partitions = null);
}
