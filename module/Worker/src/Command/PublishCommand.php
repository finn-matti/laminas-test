<?php

declare(strict_types=1);

namespace Worker\Command;

use Worker\Service\RabbitmqService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class PublishCommand extends Command
{
    protected RabbitmqService $queue;

    public function __construct(RabbitmqService $queue)
    {
        $this->queue = $queue;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('message', InputArgument::REQUIRED, 'Greeting Message');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = $input->getArgument('message');

        $client = $this->queue->getClient();
        $client->connect();

        $channel = $client->channel();
        $channel->exchangeDeclare('order-exchange', 'topic', false, true);

        $channel->queueDeclare('e360queue', false, true);
        $channel->publish(
            $message,            // The message you're publishing as a string
            [],               // Any headers you want to add to the message
            'order-exchange', // Exchange name
            'e360queue',       // Routing key, in this example the queue's name
        );
        return 0;
    }
}
