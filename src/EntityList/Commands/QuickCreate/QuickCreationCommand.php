<?php

namespace Code16\Sharp\EntityList\Commands\QuickCreate;

use Code16\Sharp\EntityList\Commands\EntityCommand;
use Code16\Sharp\Form\Fields\SharpFormField;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Utils\Fields\FieldsContainer;

class QuickCreationCommand extends EntityCommand
{
    protected ?string $title = null;
    protected SharpForm $sharpForm;

    public function __construct(protected ?array $specificFormFields) {}

    public function label(): ?string
    {
        return $this->title;
    }
    
    public function buildCommandConfig(): void
    {
        $this->configureFormModalSubmitAndReopenButton();
    }
    
    public function buildFormFields(FieldsContainer $formFields): void
    {
        $this->sharpForm
            ->getBuiltFields()
            ->when(
                $this->specificFormFields,
                fn ($sharpFormFields) => $sharpFormFields
                    ->filter(fn (SharpFormField $field) => in_array($field->key, $this->specificFormFields))
            )
            ->each(fn (SharpFormField $field) => $formFields->addField($field));
    }
    
    protected function initialData(): array
    {
        return $this->sharpForm->create();
    }
    
    public function rules(): array
    {
        return method_exists($this->sharpForm, 'rules')
            ? $this->sharpForm->rules()
            : [];
    }

    public function messages(): array
    {
        return method_exists($this->sharpForm, 'messages')
            ? $this->sharpForm->messages()
            : [];
    }
    
    public function getDataLocalizations(): array
    {
        return $this->sharpForm->getDataLocalizations();
    }
    
    public function execute(array $data = []): array
    {
        $instanceId = $this->sharpForm->update(null, $data);
        $entityKey = sharp()->context()->entityKey();
        $currentUrl = sharp()->context()->breadcrumb()->getCurrentSegmentUrl();

        return $this->sharpForm->isDisplayShowPageAfterCreation()
            ? $this->link(sprintf(
                '%s/s-show/%s/%s',
                $currentUrl,
                sharp_normalize_entity_key($entityKey)[0],
                $instanceId
            ))
            : $this->reload();
    }

    public function setFormInstance(SharpForm $form): self
    {
        $this->sharpForm = $form;
        
        return $this;
    }
    
    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
}
