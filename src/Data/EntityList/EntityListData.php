<?php

namespace Code16\Sharp\Data\EntityList;


use Code16\Sharp\Data\BreadcrumbData;
use Code16\Sharp\Data\Data;
use Code16\Sharp\Data\DataCollection;
use Code16\Sharp\Data\NotificationData;

final class EntityListData extends Data
{
    public function __construct(
        /** @var DataCollection<string,EntityListFieldData> */
        public DataCollection $containers,
        /** @var DataCollection<EntityListFieldLayoutData> */
        public DataCollection $layout,
        /** @var array<array<string,mixed>> */
        public array $data,
        /** @var array<string,mixed> */
        public array $fields,
        public EntityListConfigData $config,
        /** @var DataCollection<EntityListMultiformData> */
        public DataCollection $forms,
        /** @var DataCollection<NotificationData> */
        public DataCollection $notifications,
        public BreadcrumbData $breadcrumb,
        public EntityListAuthorizationsData $authorizations,
    ) {
    }
    
    public static function from(array $entityList): self
    {
        return new self(
            containers: EntityListFieldData::collection($entityList['containers']),
            layout: EntityListFieldLayoutData::collection($entityList['layout']),
            data: $entityList['data'],
            fields: $entityList['fields'],
            config: EntityListConfigData::from($entityList['config']),
            forms: EntityListMultiformData::collection($entityList['forms']),
            notifications: NotificationData::collection($entityList['notifications']),
            breadcrumb: BreadcrumbData::from($entityList['breadcrumb']),
            authorizations: new EntityListAuthorizationsData(...$entityList['authorizations']),
        );
    }
}
