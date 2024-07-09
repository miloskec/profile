<?php

namespace App\Console\Commands;

use App\Models\Profile;
use Illuminate\Console\Command;
use Junges\Kafka\Contracts\ConsumerMessage;
use Junges\Kafka\Contracts\MessageConsumer;
use Junges\Kafka\Facades\Kafka;

class ConsumeKafkaMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:consume-kafka-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from Kafka topic';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Kafka consumer...');
        $consumer = Kafka::consumer([config('kafka.topics.user_created.topic')])
            ->withBrokers(config('brokers'))
            ->withConsumerGroupId(config('kafka.topics.user_created.topic').'_profile')
            ->withAutoCommit()
            ->withHandler(function (ConsumerMessage $message, MessageConsumer $consumer) {
                $user = $this->handleUser($message);
                $this->createUser($user);
            })
            ->build();

        $consumer->consume();
    }

    protected function handleUser(ConsumerMessage $message): array
    {
        $user = json_decode($message->getBody()['user'], true);
        $user['user_id'] = $user['id'];
        unset($user['id']);

        return $user;
    }

    protected function createUser(array $user): void
    {
        $profile['user_id'] = $user['user_id'];
        $profile['address'] = fake()->address();
        $profile['phone_number'] = fake()->phoneNumber();
        $profile['birthdate'] = fake()->date();
        $profile['bio'] = fake()->sentence();

        Profile::create($profile);

    }
}
