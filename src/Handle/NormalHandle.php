<?php
/**
 * Class NormalHandle
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Handle;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class NormalHandle
 * @package Costalong\Swoft\Kafka\Handle
 * @Bean()
 */
class NormalHandle implements HandleInterface
{

    /**
     * @param \RdKafka\Message $message
     * @param callable $func
     * @return mixed
     */
    public function handle(\RdKafka\Message $message, callable $func)
    {
        return $func($message);
    }

    /**
     * @return mixed|void
     */
    public function handleByCode(int $code,callable $func)
    {
        return $func($func);
    }
}
