<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

use Costalong\Swoft\Kafka\Kafka;

return [
    'config' => [
        'path' => __DIR__ . '/config',
    ],
    "kafka" =>[
        "class" => Kafka::class,
        "brokers" => "127.0.0.1:9092",
        "consumeTime" => 1000 * 12, // 1000 是1秒
        "topics" => [
            [
                "name" => "topic_name",
                "brokers" => "192.168.11.101:9092",
                "consumer" => [
                    "class" => \Costalong\Swoft\Kafka\Consumers\HighConsumer::class,
                    "options" => [
//                        "request.required.acks" => 1,
                        "group.id" => "groupId",
//                        "auto.offset.reset" => "earliest",
//                        "metadata.request.timeout.ms" => 1000,
//                        "enable.auto.commit" => true,
                    ],
                    "topicOptions" => [
                        "auto.commit.interval.ms" => 100,
//                        "auto.offset.reset" => "earliest",
//                        "auto.offset.reset" => "largest",
//                        "auto.offset.reset" => "largest",
//                        "offset.store.method" => "broker",
                    ],
                    "offset"=> RD_KAFKA_OFFSET_STORED,
                    "handleClass" => \Costalong\Swoft\Kafka\Example\HandleResult::class
                ],
                "producer" => [
                    "class" => \Costalong\Swoft\Kafka\Producers\Producer::class,
                ],
            ],
        ]
    ],
];
