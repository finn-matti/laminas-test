<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 *
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Tester;

use Tester\Command\HelloCommand;
use Tester\Command\PublishCommand;

return [
    'laminas-cli'  => [
        'commands' => [
            'test:hello' => HelloCommand::class,
            'test:publish' => PublishCommand::class,
        ],
    ],
];
