<?php

declare(strict_types=1);

namespace Worker\Command;

use Worker\Service\RabbitmqService;
use Bunny\Channel;
use Bunny\Client;
use Bunny\Message;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function sprintf;

final class HelloCommand extends Command
{
    protected RabbitmqService $queue;

    public function __construct(RabbitmqService $dependency)
    {
        $this->queue = $dependency;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->queue->getClient();
        $client->connect();

        $channel = $client->channel();
        $channel->exchangeDeclare('order-exchange', 'topic', false, true);

        $channel->queueDeclare('e360queue', false, true);

        $channel->queueBind('e360queue', 'order-exchange', 'e360queue');

        $channel->run(
            function (Message $message, Channel $channel, Client $client) use ($output) {
                $success = $this->handleMessage($message, $output); // Handle your message here
                if ($success) {
                    $channel->ack($message); // Acknowledge message
                    return;
                }
                $channel->nack($message); // Mark message fail, message will be redelivered
            },
            'e360queue'
        );
        return 0;
    }

    protected function handleMessage(Message $message, OutputInterface $output): bool
    {
        $str = $message->content;
        $output->writeln(sprintf('<info>Hello %s<info>! ', $str));
        return true;
    }
}
