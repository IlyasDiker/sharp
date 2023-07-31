<?php

namespace Code16\Sharp\Data;

class InstanceAuthorizationsData extends Data
{
    public function __construct(
        public bool $view,
        public bool $create,
        public bool $update,
        public bool $delete,
    ) {
    }
}
