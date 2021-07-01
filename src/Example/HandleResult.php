<?php
/**
 * Class HandleResult
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Example;

use Costalong\Swoft\Kafka\ResultData\BaseDataResult;
use Costalong\Swoft\Kafka\ResultData\HandleDataInterface;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class HandleResult
 * @package Costalong\Swoft\Kafka\Example
 * @Bean()
 */
class HandleResult extends BaseDataResult implements HandleDataInterface
{

    public function handle()
    {
       return $this->toArray();
    }
}
