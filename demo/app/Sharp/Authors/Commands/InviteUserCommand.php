<?php

namespace App\Sharp\Authors\Commands;

use Code16\Sharp\EntityList\Commands\EntityCommand;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Utils\Fields\FieldsContainer;
use Code16\Sharp\Utils\PageAlerts\PageAlert;

class InviteUserCommand extends EntityCommand
{
    public function label(): ?string
    {
        return 'Invite new author...';
    }

    public function buildCommandConfig(): void
    {
        $this->configureFormModalTitle('Invite a new user as author')
            ->configureFormModalDescription('Provide the email address of the new author, and an invitation will be sent to him (not true, we won’t send anything).');
    }

    public function buildFormFields(FieldsContainer $formFields): void
    {
        $formFields->addField(
            SharpFormTextField::make('email')
                ->setLabel('Email'),
        );
    }

    public function execute(array $data = []): array
    {
        $this->validate($data, [
            'email' => ['required', 'email'],
        ]);

        // Here we send an invitation, or something

        return $this->info('Invitation sent!');
    }
}
