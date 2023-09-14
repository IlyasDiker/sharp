<?php

namespace Code16\Sharp\Data\Dashboard;


use Code16\Sharp\Data\Commands\ConfigCommandsData;
use Code16\Sharp\Data\Data;
use Code16\Sharp\Data\Filters\ConfigFiltersData;
use Spatie\TypeScriptTransformer\Attributes\Optional;

final class DashboardConfigData extends Data
{
    public function __construct(
        #[Optional]
        public ?ConfigCommandsData $commands = null,
        #[Optional]
        public ?ConfigFiltersData $filters = null,
    ) {
    }

    public static function from(array $config): self
    {
        $config = [
            ...$config,
            'commands' => isset($config['commands'])
                ? ConfigCommandsData::from($config['commands'])
                : null,
            'filters' => isset($config['filters'])
                ? ConfigFiltersData::from($config['filters'])
                : null,
        ];

        return new self(...$config);
    }
}
