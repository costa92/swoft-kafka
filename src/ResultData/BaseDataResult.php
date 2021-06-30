<?php
/**
 * Class BaseDataResult
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\ResultData;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class BaseDataResult
 * @package Costalong\Swoft\Kafka\ResultData
 * @Bean()
 */
class BaseDataResult
{
    /**
     * @Inject()
     * @var HandleMessage
     */
    protected $handleMessage;

    /**
     * @var \RdKafka\Message
     */
    protected $message;

    /**
     * @var
     */
    protected $data;

    /**
     * @return HandleMessage
     */
    public function getHandleMessage(): HandleMessage
    {
        return $this->handleMessage;
    }

    /**
     * @param HandleMessage $handleMessage
     */
    public function setHandleMessage(HandleMessage $handleMessage): void
    {
        $this->handleMessage = $handleMessage;
    }


    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }
    /**
     * @return \RdKafka\Message
     */
    public function getMessage(): \RdKafka\Message
    {
        return $this->message;
    }
    /**
     * @param \RdKafka\Message $message
     */
    public function setMessage(\RdKafka\Message $message): void
    {
        $this->message = $message;
    }

    /**
     *
     */
    public function initData()
    {
        $this->handleMessage->initData($this->getMessage());
    }


    /**
     *  处理结果返回数组
     */
    public function toArray():array
    {
        if( $payload = $this->handleMessage->getPayload()){
            return json_decode($payload,true);
        }
        return [];
    }

    /**
     * @return array|mixed
     */
    public function toJson():string
    {
        if( $payload = $this->handleMessage->getPayload()){
            return $payload;
        }
        return [];
    }
}
