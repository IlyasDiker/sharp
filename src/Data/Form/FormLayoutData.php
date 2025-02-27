<?php

namespace Code16\Sharp\Data\Form;

use Code16\Sharp\Data\Data;

/**
 * @internal
 */
final class FormLayoutData extends Data
{
    public function __construct(
        public bool $tabbed,
        /** @var FormLayoutTabData[] */
        public array $tabs,
    ) {}

    public static function from(array $config): self
    {
        return new self(
            tabbed: $config['tabbed'],
            tabs: FormLayoutTabData::collection($config['tabs']),
        );
    }
}
