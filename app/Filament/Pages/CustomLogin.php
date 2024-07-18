<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Auth\Login;

class CustomLogin extends Login
{
    public function registerAction(): Action
    {
        return Action::make('register')
            ->link()
            ->color('info')
            ->label(__('filament-panels::pages/auth/login.actions.register.label'))
            ->url(filament()->getRegistrationUrl());
    }

    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->color('info')
            ->label(__('filament-panels::pages/auth/login.form.actions.authenticate.label'))
            ->submit('authenticate');
    }
}
