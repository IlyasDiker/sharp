<?php

namespace App\Providers;

use Code16\Sharp\Config\SharpConfigBuilder;
use Code16\Sharp\SharpAppServiceProvider;
use App\Sharp\SharpMenu;

class SharpServiceProvider extends SharpAppServiceProvider
{
    protected function configureSharp(SharpConfigBuilder $config): void
    {
        $config
            ->setName('E2E')
            ->setSharpMenu(SharpMenu::class);
//            ->addEntity('posts', PostEntity::class)
    }

    protected function declareAccessGate(): void
    {
//        Gate::define('viewSharp', function ($user) {
//            return $user->is_sharp_admin;
//        });
    }
}
