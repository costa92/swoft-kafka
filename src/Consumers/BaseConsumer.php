<?php
/**
 * Class BaseConsumer
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Consumers;

use Costalong\Swoft\Kafka\Common;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Costalong\Swoft\Kafka\ResultData\HandleDataInterface;
use Costalong\Swoft\Kafka\ResultData\HandleResult;
use Exception;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class BaseConsumer
 * @package Costalong\Swoft\Kafka\LowConsumer1
 * @Bean()
 */
class BaseConsumer extends Common
{

    /**
     * @var \RdKafka\Topic
     */
    protected $topic = null;

    /**
     * @var int
     */
    protected $partition = 0;

    /**
     * @var string
     */
    protected $handleClass = "";


    /**
     *
     *   KAFKA_OFFSET_STORED // 通过offset和group来获取消息(必须设置group)
     *   RD_KAFKA_OFFSET_BEGINNING 开头
     *   RD_KAFKA_OFFSET_END // 从尾部开始获取新的massage
     * @var int
     */
    protected $offset = RD_KAFKA_OFFSET_BEGINNING;



    /**
     * @return int
     */
    public function getPartition(): int
    {
        return $this->partition;
    }

    /**
     * @param int $partition
     */
    public function setPartition(int $partition): void
    {
        $this->partition = $partition;
    }

    /**
     * @return string
     */
    public function getHandleClass(): string
    {
        return $this->handleClass;
    }

    /**
     * @param string $handleClass
     */
    public function setHandleClass(string $handleClass): void
    {
        $this->handleClass = $handleClass;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }




    /**
     * @return HandleDataInterface|false
     * @throws KafkaException
     */
    public function run()
    {
        if($this instanceof LowConsumer && $this->topic){
            $message = $this->topic->consume($this->getPartition(), $this->kafka->getConsumeTime());
        }elseif ($this instanceof HighConsumer && $this->consume){
            $message = $this->consume->consume($this->kafka->getConsumeTime());
        }else {
            return false;
        }

        if ($message){
            /** @var HandleResult $handleResult */
            $handleResult =  BeanFactory::getSingleton(HandleResult::class);
            $handleResult->setHandleClass($this->getHandleClass());
            return $handleResult->handleResult($message);
        }
        return false;
    }

}
