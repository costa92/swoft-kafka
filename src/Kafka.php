<?php
/**
 * Class Kafka
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka;

/**
 * Class Kafka
 * @package Costalong\Swoft\Kafka
 *
 */
class Kafka
{
    /**
     * @var string
     */
    protected $brokers = "";

    /**
     * @var int
     */
    protected $consumeTime = 1000;

    /**
     * @var array
     */
    protected $topics;

    /**
     * @var
     */
    protected $topicConf;

    /**
     * @var
     */
    protected $highConsume;

    /**
     * @return string
     */
    public function getBrokers(): string
    {
        return $this->brokers;
    }

    /**
     * @return int
     */
    public function getConsumeTime(): int
    {
        return $this->consumeTime;
    }

    /**
     * @return array
     */
    public function getTopics(): array
    {
        return $this->topics;
    }

    /**
     * @param int $consumeTime
     */
    public function setConsumeTime(int $consumeTime): void
    {
        $this->consumeTime = $consumeTime;
    }

    /**
     * @return mixed
     */
    public function getTopicConf()
    {
        return $this->topicConf;
    }

    /**
     * @param mixed $topicConf
     */
    public function setTopicConf($topicConf): void
    {
        $this->topicConf = $topicConf;
    }

    /**
     * @return mixed
     */
    public function getHighConsume()
    {
        return $this->highConsume;
    }

    /**
     * @param mixed $highConsume
     */
    public function setHighConsume($highConsume): void
    {
        $this->highConsume = $highConsume;
    }


}
