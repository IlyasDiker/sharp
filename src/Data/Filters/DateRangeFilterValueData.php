<?php

namespace Code16\Sharp\Data\Filters;

use Code16\Sharp\Data\Data;
use Code16\Sharp\Enums\FilterType;

final class DateRangeFilterValueData extends Data
{
    public function __construct(
        public string $start,
        public string $end,
    ) {
    }

    public static function from(array $value): self
    {
        return new self(...$value);
    }
}
