<?php
/**
 * Class DefaultDataResult
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\ResultData;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class DefaultDataResult
 * @package Costalong\Swoft\Kafka\ResultData
 * @Bean()
 */
class DefaultDataResult extends BaseDataResult implements HandleDataInterface
{
    /**
     * @return mixed|void
     */
    public function handle()
    {
        return $this->getHandleMessage();
    }
}
