<?php

namespace App\Sharp;

use Code16\Sharp\EntityList\Fields\EntityListField;
use Code16\Sharp\EntityList\Fields\EntityListFieldsContainer;
use Code16\Sharp\EntityList\SharpEntityList;
use Illuminate\Contracts\Support\Arrayable;

class TestModelList extends SharpEntityList
{
    protected function buildList(EntityListFieldsContainer $fields): void
    {
        $fields
            ->addField(
                EntityListField::make('my_field')
                    ->setLabel('My field')
                    ->setWidth(4)
                    ->setWidthOnSmallScreens(6),
            );
    }

    public function buildListConfig(): void
    {
        $this
            ->configureDefaultSort('created_at', 'desc');
    }

    protected function getInstanceCommands(): ?array
    {
        return [];
    }

    protected function getEntityCommands(): ?array
    {
        return [];
    }

    protected function getFilters(): array
    {
        return [];
    }

    public function getListData(): array|Arrayable
    {
        return $this
            ->transform([]);
    }
}
