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
                "brokers" => "127.0.0.1:9092",
                "consumer" => [
                    "class" => \Costalong\Swoft\Kafka\Consumers\LowConsumer::class,
                    "options" => [
                        "request.required.acks" => 1,
                        "group.id" => "groupId",
                        "auto.offset.reset" => "earliest",
                    ],
                    "topicOptions" => [
                        "auto.commit.interval.ms" => 100,
                        "offset.store.method" => "broker",
                        "auto.offset.reset" => "earliest",
                    ],
                    "handleClass" => \Costalong\Swoft\Kafka\Example\HandleResult::class
                ],
                "producer" => [
                    "class" => \Costalong\Swoft\Kafka\Producers\Producer::class,
                ],
            ],
        ]
    ],
];
