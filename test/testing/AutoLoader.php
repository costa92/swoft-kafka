<?php
/**
 * Class AutoLoader
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Testing;

use Costalong\Swoft\Kafka\Kafka;
use Swoft\SwoftComponent;

/**
 * Class AutoLoader
 *
 * @since 2.0
 */
class AutoLoader extends SwoftComponent
{
    /**
     * Get namespace and dirs
     *
     * @return array
     */
    public function getPrefixDirs(): array
    {
        return [
            __NAMESPACE__ => __DIR__,
        ];
    }

    /**
     * @return array
     */
    public function metadata(): array
    {
        return [];
    }

    /**
     * @return string[][]
     */
    public function beans(): array
    {
        return [
            "kafka" => [
                "class" => Kafka::class,
                "brokers" => "192.168.11.120"
            ],
        ];
    }
}
