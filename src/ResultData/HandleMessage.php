<?php
/**
 * Class HandleMessage
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\ResultData;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class HandleMessage
 * @package Costalong\Swoft\Kafka\ResultData
 * @Bean()
 */
class HandleMessage
{
    /**
     * @var string
     */
    protected $topicName;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var
     */
    protected $partition;
    /**
     * @var
     */
    protected $payload;
    /**
     * @var
     */
    protected $len;
    /**
     * @var
     */
    protected $key;

    /**
     * @var
     */
    protected $offset;
    /**
     * @var
     */
    protected $headers;

    /**
     * @return string
     */
    public function getTopicName(): string
    {
        return $this->topicName;
    }

    /**
     * @param mixed $topicName
     */
    public function setTopicName($topicName): void
    {
        $this->topicName = $topicName;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getPartition()
    {
        return $this->partition;
    }

    /**
     * @param mixed $partition
     */
    public function setPartition($partition): void
    {
        $this->partition = $partition;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function setPayload($payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return mixed
     */
    public function getLen()
    {
        return $this->len;
    }

    /**
     * @param mixed $len
     */
    public function setLen($len): void
    {
        $this->len = $len;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key): void
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param mixed $offset
     */
    public function setOffset($offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }

    /**
     * 初始化的数据
     * @param $message
     */
    public function initData($message)
    {
        foreach ($message as $key => $value){
             $property = $this->convertUnderline($key);
             if (!isset($this->{$property})){
                 $this->{$property} = $value;
             }
        }
    }

    /**
     *  下划线转成驼峰方式
     * @param $str
     * @return string|string[]|null
     */
    protected function convertUnderline($str)
    {
        return preg_replace_callback('/([-_]+([a-z]{1}))/i', function ($matches) {
            return strtoupper($matches[2]);
        }, $str);
    }
}
