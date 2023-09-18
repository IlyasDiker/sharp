<?php

namespace Code16\Sharp\Data\Commands;


use Code16\Sharp\Data\Data;
use Code16\Sharp\Data\DataCollection;
use Code16\Sharp\Data\Form\Fields\FormFieldData;
use Code16\Sharp\Data\Form\FormConfigData;
use Code16\Sharp\Data\Form\FormLayoutData;
use Code16\Sharp\Data\InstanceAuthorizationsData;
use Code16\Sharp\Data\PageAlertData;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;

final class CommandFormData extends Data
{
    public function __construct(
        #[LiteralTypeScriptType('{ [key:string]: FormFieldData["value"] }')]
        public ?array $data,
        /** @var DataCollection<string,FormFieldData> */
        public ?DataCollection $fields = null,
        public ?FormLayoutData $layout = null,
        /** @var array<string> */
        public ?array $locales = null,
        public ?PageAlertData $pageAlert = null,
    ) {
    }

    public static function from(array $form): self
    {
        return new self(
            data: $form['data'],
            fields: isset($form['fields'])
                ? FormFieldData::collection($form['fields'])
                : null,
            layout: FormLayoutData::optional($form['layout'] ?? null),
            locales: $form['locales'] ?? null,
            pageAlert: PageAlertData::optional($form['pageAlert']),
        );
    }
}
