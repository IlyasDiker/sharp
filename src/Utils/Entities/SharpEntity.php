<?php

namespace Code16\Sharp\Utils\Entities;

use Code16\Sharp\EntityList\SharpEntityList;
use Code16\Sharp\Exceptions\SharpInvalidEntityKeyException;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Show\SharpShow;

abstract class SharpEntity extends BaseSharpEntity
{
    protected bool $isSingle = false;
    protected ?string $list = null;
    protected ?string $form = null;
    protected ?string $show = null;
    protected array $prohibitedActions = [];

    final public function getListOrFail(): SharpEntityList
    {
        if (! $list = $this->getList()) {
            throw new SharpInvalidEntityKeyException("The list for the entity [{$this->entityKey}] was not found.");
        }

        return $list instanceof SharpEntityList ? $list : app($list);
    }

    final public function getShowOrFail(): SharpShow
    {
        if (! $show = $this->getShow()) {
            throw new SharpInvalidEntityKeyException("The show for the entity [{$this->entityKey}] was not found.");
        }

        return $show instanceof SharpShow ? $show : app($show);
    }

    final public function hasShow(): bool
    {
        return $this->getShow() !== null;
    }

    final public function getFormOrFail(?string $subEntity = null): SharpForm
    {
        if ($subEntity) {
            if (! $form = ($this->getMultiforms()[$subEntity][0] ?? null)) {
                throw new SharpInvalidEntityKeyException("The subform for the entity [{$this->entityKey}:{$subEntity}] was not found.");
            }
        } elseif (! $form = $this->getForm()) {
            throw new SharpInvalidEntityKeyException("The form for the entity [{$this->entityKey}] was not found.");
        }

        return $form instanceof SharpForm ? $form : app($form);
    }

    final public function isActionProhibited(string $action): bool
    {
        return in_array($action, $this->prohibitedActions);
    }

    final public function isSingle(): bool
    {
        return $this->isSingle;
    }

    final public function getLabel(?string $subEntity = null): string
    {
        return $subEntity ? $this->getMultiforms()[$subEntity][1] : $this->label;
    }

    protected function getList(): ?SharpEntityList
    {
        if ($this->isSingle) {
            throw new SharpInvalidEntityKeyException("The entity [{$this->entityKey}] is single, and does not have a list.");
        }

        return $this->list ? app($this->list) : null;
    }

    protected function getShow(): ?SharpShow
    {
        return $this->show ? app($this->show) : null;
    }

    protected function getForm(): ?SharpForm
    {
        return $this->form ? app($this->form) : null;
    }

    public function getMultiforms(): array
    {
        return [];
    }
}
