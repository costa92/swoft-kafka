<?php
/**
 * Class KafkaTopicTest
 * author:costalong
 * Email:longqiuhong@163.com
 */

namespace Costalong\Swoft\Kafka\Unit;


use Costalong\Swoft\Kafka\Consumers\HighConsumer;
use Costalong\Swoft\Kafka\Consumers\LowConsumer;
use Costalong\Swoft\Kafka\Topic\Topics;
use Exception;
use PHPUnit\Framework\TestCase;
use Swoft\Bean\BeanFactory;

class KafkaTopicTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function testConsumer()
    {
        /** @var Topics   $topics */
        $topics = BeanFactory::getSingleton(Topics::class);
        $topics->setTopicName("topic_name");
        $topics->setGroupId("groupId");
        /** @var HighConsumer $consumer */
        $consumer = $topics->consumer();

        for ($i=0;$i < 10;$i++) {
            $result = $consumer->run();
            var_dump($result->handle());
        }
    }


    /**
     * @throws Exception
     */
    public function testHighConsumer()
    {
        /** @var Topics   $topics */
        $topics = BeanFactory::getSingleton(Topics::class);
        $topics->setTopicName("topic_name");
        /** @var LowConsumer $consumer */
        $consumer = $topics->consumer();
        $consumer->setPartition(0);
        for ($i=0;$i < 10;$i++) {
            $result = $consumer->run();
            var_dump($result);
        }
    }

    /**
     * @throws Exception
     */
    public function testProducer()
    {
        /** @var Topics   $topics */
        $topics = BeanFactory::getSingleton(Topics::class);
        $topics->setTopicName("topic_name");
        $producer = $topics->producer();
        $producer->setPartitions(0);
        for ($i=0;$i < 10;$i++) {
            $producer->setMessage(["data"=>"test","date"=>date("Y-m-d H:i:s")]);
            $producer->send();
        }
    }
}
