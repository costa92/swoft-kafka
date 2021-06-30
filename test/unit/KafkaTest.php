<?php
/**
 * Class TestKafka
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Unit;

use Costalong\Swoft\Kafka\Consumers\HighConsumer;
use Exception;
use PHPUnit\Framework\TestCase;
use Swoft\Bean\BeanFactory;

class KafkaTest extends TestCase
{

    /**
     *
     */
    public function testVersion()
    {
        $rftExt  = new \ReflectionExtension("rdkafka");
        var_dump( $rftExt->getVersion());
    }


    /**
//     * @throws Exception
//     */
//    public function testProducer()
//    {
//        /** @var Producer $producer */
//        $producer = BeanFactory::getBean(Producer::class);
//        $producer->setTopicName("swoft_topic");
////        $producer->setPartitions(1);
//        for ($i=0;$i < 10;$i++) {
//            $producer->setMessage(["data"=>"test","date"=>date("Y-m-d H:i:s")]);
//            $producer->send();
//        }
//    }

//    /**
//     * @throws Exception
//     */
//    public function testConsumer()
//    {
//        /** @var LowConsumer $consumer */
//        $consumer = BeanFactory::getBean(LowConsumer::class);
//        $consumer->setTopicName("swoft_topic");
//        $consumer->setPartition(0);
//        $topic =  $consumer->consume();
//         for ($i=0;$i < 10;$i++) {
//             $result = $consumer->handleConsume($topic);
//             var_dump($result);
//         }
//    }

    /**
     * @throws Exception
     */
    public function testHighConsumer()
    {
        /** @var HighConsumer $highConsumer */
        $highConsumer = BeanFactory::getBean(HighConsumer::class);
        $highConsumer->setTopicName("swoft_topic");
        $highConsumer->setGroupId("groupId");
        $consume = $highConsumer->consume();
//        for ($i=0;$i < 10;$i++){
            $result = $highConsumer->handleConsume($consume);
            var_dump($result);
//        }
    }


}
