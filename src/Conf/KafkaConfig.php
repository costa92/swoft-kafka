<?php
/**
 * Class KafkaConfig
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Conf;

use Costalong\Swoft\Kafka\Exception\ExceptionHandle\ConsumeExceptionHandle;
use Costalong\Swoft\Kafka\Exception\ExceptionHandle\LogExceptionHandle;
use Costalong\Swoft\Kafka\Exception\ExceptionHandle\RefusedExceptionHandle;
use Costalong\Swoft\Kafka\Exception\KafkaException;
use Costalong\Swoft\Kafka\Options\Options;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class KafkaConfig
 * @package Costalong\Swoft\Kafka\Conf
 * @Bean()
 */
class KafkaConfig
{

    /**
     * @var string
     */
    protected $brokers = "127.0.0.1:9092";

    /**
     * @return string
     */
    public function getBrokers(): string
    {
        return $this->brokers;
    }

    /**
     * @param string $brokers
     */
    public function setBrokers(string $brokers): void
    {
        $this->brokers = $brokers;
    }


    /**
     * @return \RdKafka\Conf
     * @throws KafkaException
     */
    public function getRdKafkaConf(): \RdKafka\Conf
    {
        $conf = new \RdKafka\Conf();


        $conf->setErrorCb(function($kafka, $err, $reason){
            /** @var RefusedExceptionHandle  $refusedHandle */
            $refusedHandle  =  BeanFactory::getBean(RefusedExceptionHandle::class);
            $refusedHandle->handle($kafka,$err,$reason);
        });


        $conf->setLogCb(function ($kafka, $level, $facility, $message) {
            /** @var LogExceptionHandle $logException */
            $logException = BeanFactory::getSingleton(LogExceptionHandle::class);
            $logException->handle($kafka,$level,$facility,$message);
        });

        $conf->setConsumeCb(function ($msg) {
            /** @var ConsumeExceptionHandle $ConsumeException */
            $ConsumeException = BeanFactory::getSingleton(ConsumeExceptionHandle::class);
            $ConsumeException->handle($msg);
        });


        $conf->set('metadata.broker.list', $this->getBrokers());

        return $conf;

    }


    /**
     * @param \RdKafka\Conf $conf
     * @param array $KafkaOptions
     * @return TopicConf|mixed|\RdKafka\Conf
     * @throws KafkaException
     */
    public function leadOption(\RdKafka\Conf $conf,array $KafkaOptions)
    {
        /** @var Options $options */
        $options = BeanFactory::getSingleton(Options::class);
        return $options->initOptions($conf,$KafkaOptions);
    }
}
