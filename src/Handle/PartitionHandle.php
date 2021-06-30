<?php
/**
 * Class PartitionHandle
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Handle;

/**
 * 分区错误
 * Class PartitionHandle
 * @package Costalong\Swoft\Kafka\Handle
 */
class PartitionHandle implements HandleInterface
{

    public function handle(\RdKafka\Message $message, callable $func)
    {
        echo "No more messages; will wait for more\n";
        return $func(false);
    }
}
