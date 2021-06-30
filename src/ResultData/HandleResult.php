<?php
/**
 * Class HandleResult
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\ResultData;

use Costalong\Swoft\Kafka\Containers\Container;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class HandleResult
 * @package Costalong\Swoft\Kafka\ResultData
 * @Bean()
 */
class HandleResult
{
    /**
     * @var
     */
    protected $handleClass;

    /**
     * @return mixed
     */
    public function getHandleClass()
    {
        return $this->handleClass;
    }

    /**
     * @param mixed $handleClass
     */
    public function setHandleClass($handleClass): void
    {
        $this->handleClass = $handleClass;
    }



    /**
     * @param \RdKafka\Message $message
     * @return HandleDataInterface
     * @throws KafkaException
     */
    public function handleResult(\RdKafka\Message $message):HandleDataInterface
    {
        /** @var Container $container */
        $container = BeanFactory::getSingleton(Container::class);
        /** @var HandleDataInterface $dataResult */
        if ($this->getHandleClass()){
            $dataResult = BeanFactory::getSingleton($this->getHandleClass());
            if (($dataResult instanceof BaseDataResult) == false ){
                throw new KafkaException("current class not extend BaseDataResult class,please check ".$this->getHandleClass());
            }
            if (($dataResult instanceof HandleDataInterface ) == false  ){
                throw new KafkaException("current class not implements HandleDataInterface interface,please check ".$this->getHandleClass());
            }
        }else{
            $dataResult = BeanFactory::getSingleton(DefaultDataResult::class);
        }
        return $container->handleResult($message,function ($message) use ($dataResult){
            $dataResult->setMessage($message);
            $dataResult->initData();
            return $dataResult;
        });
    }
}
