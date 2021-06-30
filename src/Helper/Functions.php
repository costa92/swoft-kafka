<?php
/**
 * author:costalong
 * Email:longqiuhong@163.com
 */

/**
 * @return string
 */
function getRdKafkaVersion(): string
{
    $rftExt  = new \ReflectionExtension("rdkafka");
    return $rftExt->getVersion();
}
