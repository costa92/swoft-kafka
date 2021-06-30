<?php
/**
 * Class CommonInterface
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Contract;


use Costalong\Swoft\Kafka\Kafka;

/***
 * Interface CommonInterface
 * @package Costalong\Swoft\Kafka\Contract
 */
interface CommonInterface
{

    /**
     * @return string
     */
    public function getTopicName(): string;


    /**
     * @param string $topicName
     */
    public function setTopicName(string $topicName): void;

    /**
     * @return Kafka
     */
    public function getKafka(): Kafka;

    /**
     * @param Kafka $kafka
     */
    public function setKafka(Kafka $kafka): void;

    /**
     * @return mixed
     */
    public function getGroupId(): string;
    /**
     * @param mixed $groupId
     */
    public function setGroupId(string $groupId): void;
    /**
     * @param array $topicArr
     * @param string $client
     * @return mixed
     */
    public function initConf(array $topicArr,string $client);


}
