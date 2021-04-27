<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 *
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Tester;

use Tester\Service\RabbitmqService;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Tester\Command\HelloCommand;
use Tester\Command\PublishCommand;
use Tester\Command\QueueCommandFactory;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                HelloCommand::class => QueueCommandFactory::class,
                PublishCommand::class => QueueCommandFactory::class,
                RabbitmqService::class => InvokableFactory::class,
            ],
        ];
    }
}
