<?php
/**
 * Class HandleDataInterface
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\ResultData;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Interface HandleDataInterface
 * @package Costalong\Swoft\Kafka\ResultData
 * @Bean()
 */
interface HandleDataInterface
{


    /**
     * @return \RdKafka\Message
     */
    public function getMessage(): \RdKafka\Message;

    /**
     * @param \RdKafka\Message $message
     */
    public function setMessage(\RdKafka\Message $message): void;



    /**
     * @return HandleMessage
     */
    public function getHandleMessage(): HandleMessage;

    /**
     * @param HandleMessage $handleMessage
     */
    public function setHandleMessage(HandleMessage $handleMessage): void;


    /**
     * @return mixed
     */
    public function initData();

    /**
     * @return mixed
     */
    public function getData();
    /**
     * @param mixed $data
     */
    public function setData($data): void;



    /**
     * @return mixed
     */
    public function handle();

    /**
     * @return mixed
     */
    public function toArray():array;

    /**
     * @return string
     */
    public function toJson():string;
}
