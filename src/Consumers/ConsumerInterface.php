<?php
/**
 * Class ConsumerInterface
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Consumers;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Interface ConsumerInterface
 * @package Costalong\Swoft\Kafka\Consumers
 * @Bean()
 */
interface ConsumerInterface
{
    /**
     * @return mixed
     */
    public function run();

}
