<?php

namespace App\Sharp;

use Code16\Sharp\Show\Fields\SharpShowTextField;
use Code16\Sharp\Show\Layout\ShowLayout;
use Code16\Sharp\Show\Layout\ShowLayoutColumn;
use Code16\Sharp\Show\Layout\ShowLayoutSection;
use Code16\Sharp\Show\SharpShow;
use Code16\Sharp\Utils\Fields\FieldsContainer;

class TestModelShow extends SharpShow
{
    protected function buildShowFields(FieldsContainer $showFields): void
    {
        $showFields
            ->addField(
                SharpShowTextField::make('my_field')
                    ->setLabel('My field')
            );
    }

    protected function buildShowLayout(ShowLayout $showLayout): void
    {
        $showLayout
            ->addSection('My section', function (ShowLayoutSection $section) {
                $section
                    ->addColumn(12, function (ShowLayoutColumn $column) {
                        $column->withSingleField('my_field');
                    });
            });
    }

    public function buildShowConfig(): void
    {
        //
    }

    public function find($id): array
    {
        return $this->transform(...);
    }

    public function delete($id): void
    {
        //
    }
}
