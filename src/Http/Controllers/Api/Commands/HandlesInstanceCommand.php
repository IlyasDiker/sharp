<?php

namespace Code16\Sharp\Http\Controllers\Api\Commands;

use Code16\Sharp\EntityList\Commands\InstanceCommand;
use Code16\Sharp\EntityList\SharpEntityList;
use Code16\Sharp\Exceptions\Auth\SharpAuthorizationException;
use Code16\Sharp\Show\SharpShow;

trait HandlesInstanceCommand
{
    protected function getInstanceCommandHandler(
        SharpEntityList|SharpShow $commandContainer,
        string $commandKey,
        mixed $instanceId
    ): ?InstanceCommand {
        $commandHandler = $commandContainer->findInstanceCommandHandler($commandKey);
        $commandHandler->buildCommandConfig();

        if (! $commandHandler->authorize() || ! $commandHandler->authorizeFor($instanceId)) {
            throw new SharpAuthorizationException();
        }

        return $commandHandler;
    }
}
