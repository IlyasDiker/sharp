<?php

namespace Code16\Sharp\Http\Controllers;

use Code16\Sharp\Data\Show\Fields\ShowEntityListFieldData;
use Code16\Sharp\Data\Show\ShowData;
use Code16\Sharp\Data\Show\ShowLayoutColumnData;
use Code16\Sharp\Data\Show\ShowLayoutSectionData;
use Code16\Sharp\Http\Middleware\AddLinkHeadersForPreloadedRequests;

trait PreloadsShowEntityLists
{
    protected function addPreloadHeadersForShowEntityLists(ShowData $payload): void
    {
        $payload->fields->whereInstanceOf(ShowEntityListFieldData::class)
            ->each(function (ShowEntityListFieldData $entityListField) use ($payload) {
                $section = $payload->layout->sections->firstWhere(fn (ShowLayoutSectionData $section) =>
                    collect($section->columns->map(fn (ShowLayoutColumnData $column) => $column->fields))
                        ->flatten(2)
                        ->firstWhere('key', $entityListField->key)
                );
                if ($section && !$section->collapsable) {
                    app(AddLinkHeadersForPreloadedRequests::class)->preload($entityListField->endpointUrl);
                }
            });
    }
}
