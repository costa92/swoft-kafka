<?php
/**
 * Class BaseConsumer
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Consumers;

use Costalong\Swoft\Kafka\Common;
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
     * @return HandleDataInterface|false
     * @throws Exception
     */
    public function run()
    {
        if($this instanceof LowConsumer && $this->topic){
            $message = $this->topic->consume(0, $this->kafka->getConsumeTime());
        }elseif ($this instanceof HighConsumer && $this->consume){
            $message = $this->consume->consume($this->kafka->getConsumeTime());
        }else {
            return false;
        }
        /** @var HandleResult $handleResult */
        $handleResult =  BeanFactory::getSingleton(HandleResult::class);
        $handleResult->setHandleClass($this->getHandleClass());
        return $handleResult->handleResult($message);
    }

}
