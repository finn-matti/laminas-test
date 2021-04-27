<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 *
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Worker;

use Worker\Command\HelloCommand;
use Worker\Command\PublishCommand;

return [
    'laminas-cli'  => [
        'commands' => [
            'app:hello' => HelloCommand::class,
            'app:publish' => PublishCommand::class,
        ],
    ],
    'service_manager' => [
        'factories'          => [
            HelloCommand::class => QueueCommandFactory::class,
            PublishCommand::class => QueueCommandFactory::class,
            RabbitmqService::class => InvokableFactory::class,
        ],
    ]
];
