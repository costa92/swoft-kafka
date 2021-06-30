<?php
/**
 * Class RevokePartitionsHandle
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Handle\KafkaConsumer;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class RevokePartitionsHandle
 * @package Costalong\Swoft\Kafka\Handle\KafkaConsumer
 * @Bean()
 */
class RevokePartitionsHandle implements PartitionsInterface
{

    /**
     * @param \RdKafKa\KafkaConsumer $kafka
     * @param $err
     * @param array|null $partitions
     * @return mixed|void
     */
    public function handlePartition(\RdKafKa\KafkaConsumer $kafka, $err, array $partitions = null)
    {
        $kafka->assign($partitions);
    }
}
