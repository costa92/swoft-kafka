<?php
/**
 * Class TimeoutHandle
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Handle;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * 超时错误处理
 * Class TimeoutHandle
 * @package Costalong\Swoft\Kafka\Handle
 * @Bean()
 */
class TimeoutHandle implements HandleInterface
{

    public function handle(\RdKafka\Message $message, callable $func)
    {
        echo "No more messages; will wait for more\n";
        return $func(false);
    }
}
