<?php

namespace App\Factories;

use Arquivei\Events\Sender\Exporters\Kafka;

class KafkaFactory
{
    public static function create(): Kafka
    {
        return new Kafka([
            'group_id' => env('GROUP_ID'),
            'kafka_brokers' => env('KAFKA_BROKERS'),
            'security_protocol' => env('SECURITY_PROTOCOL'),
            'sasl_mechanisms' => env('SASL_MECHANISMS'),
            'sasl_username' => env('SASL_USERNAME'),
            'sasl_password' => env('SASL_PASSWORD'),
        ]);
    }
}
