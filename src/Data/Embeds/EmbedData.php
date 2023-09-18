<?php

namespace Code16\Sharp\Data\Embeds;

use Code16\Sharp\Data\Data;

final class EmbedData extends Data
{
    public function __construct(
        public string $key,
        public string $label,
        public string $tag,
        /** @var string[] */
        public array $attributes,
        public string $template,
    ) {
    }
}
