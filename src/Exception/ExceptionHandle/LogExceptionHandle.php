<?php
/**
 * Class LogExceptionHandle
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Exception\ExceptionHandle;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class LogExceptionHandle
 * @package Costalong\Swoft\Kafka\Exception\ExceptionHandle
 * @Bean()
 */
class LogExceptionHandle
{
    /**
     * @param $kafka
     * @param $level
     * @param $facility
     * @param $message
     */
    public function handle($kafka,$level,$facility,$message)
    {
        var_dump($message);
        var_dump("log level:".$level);
    }
}
