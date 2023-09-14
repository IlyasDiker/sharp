<?php

namespace Code16\Sharp\Data\Show;


use Code16\Sharp\Data\BreadcrumbData;
use Code16\Sharp\Data\Data;
use Code16\Sharp\Data\DataCollection;
use Code16\Sharp\Data\InstanceAuthorizationsData;
use Code16\Sharp\Data\NotificationData;
use Code16\Sharp\Data\PageAlertData;
use Code16\Sharp\Data\Show\Fields\ShowFieldData;
use Spatie\TypeScriptTransformer\Attributes\Optional;

final class ShowData extends Data
{
    public function __construct(
        public ShowConfigData $config,
        /** @var DataCollection<string,ShowFieldData> */
        public DataCollection $fields,
        public ShowLayoutData $layout,
        /** @var array<string,mixed> */
        public array $data,
        public ?PageAlertData $pageAlert,
        /** @var string[] */
        public ?array $locales,
        public InstanceAuthorizationsData $authorizations,
    ) {
    }

    public static function from(array $show): self
    {
        return new self(
            config: ShowConfigData::from($show['config']),
            fields: ShowFieldData::collection($show['fields']),
            layout: ShowLayoutData::from($show['layout']),
            data: $show['data'],
            pageAlert: $show['pageAlert']
                ? PageAlertData::from($show['pageAlert'])
                : null,
            locales: $show['locales'],
            authorizations: new InstanceAuthorizationsData(...$show['authorizations']),
        );
    }
}
