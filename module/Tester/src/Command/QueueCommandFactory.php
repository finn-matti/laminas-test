<?php

/**
 * @see       https://github.com/laminas/laminas-cli for the canonical source repository
 * @copyright https://github.com/laminas/laminas-cli/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-cli/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Tester\Command;

use Tester\Service\RabbitmqService;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

class QueueCommandFactory
{
    public function __invoke(ContainerInterface $container, string $requestedName): Command
    {
        $dependency = $container->get(RabbitmqService::class);
        print_r($container->get('config'));
        return new $requestedName($dependency);
    }
}
