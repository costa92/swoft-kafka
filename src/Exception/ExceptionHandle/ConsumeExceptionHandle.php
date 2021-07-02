<?php
/**
 * Class ConsumeExceptionHandle
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Exception\ExceptionHandle;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Log\Helper\Log;

/**
 * Class ConsumeExceptionHandle
 * @package Costalong\Swoft\Kafka\Exception\ExceptionHandle
 * @Bean()
 */
class ConsumeExceptionHandle
{
    /**
     * @param $msg
     */
    public function handle($msg)
    {
        Log::error($msg);
    }
}
