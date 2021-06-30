<?php
/**
 * Class HandleDataInterface
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Handle;

/**
 * Interface HandleDataInterface
 * @package Costalong\Swoft\Kafka\Handle
 */
interface HandleInterface
{
    /**
     * @param \RdKafka\Message $message
     * @param callable $func
     * @return mixed
     */
    public function handle(\RdKafka\Message $message,callable $func);
}
