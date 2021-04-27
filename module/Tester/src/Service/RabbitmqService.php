<?php

declare(strict_types=1);

namespace Tester\Service;

use Bunny\Client;

final class RabbitmqService
{
    protected ?Client $client;

    public function getClient(): Client
    {
        if (!isset($this->client)) {
            $connection = [
                'host'      => $_ENV['rmq_host'],
                'vhost'     => $_ENV['rmq_vhost'],    // The default vhost is /
                'user'      => $_ENV['rmq_user'], // The default user is guest
                'password'  => $_ENV['rmq_password'], // The default password is guest
            ];
            $this->client = new Client($connection);
        }

        return $this->client;
    }
}
