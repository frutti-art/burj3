<?php

namespace Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class CustomRegister extends Register
{
    public function loginAction(): Action
    {
        return Action::make('login')
            ->link()
            ->color('info')
            ->label(__('filament-panels::pages/auth/register.actions.login.label'))
            ->url(filament()->getLoginUrl());
    }

    public function getRegisterFormAction(): Action
    {
        return Action::make('register')
            ->color('info')
            ->label(__('filament-panels::pages/auth/register.form.actions.register.label'))
            ->submit('register');
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getReferralCodeFormComponent(),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    private function getReferralCodeFormComponent(): TextInput
    {
        return TextInput::make('referral_code')
            ->default(request()?->query('referral_code', ''))
            ->label('Referral code')
            ->autofocus()
            ->required()
            ->maxLength(255)
            ->exists($this->getUserModel());
    }

    protected function handleRegistration(array $data): Model
    {
        $referrer = $this->getUserModel()::where('referral_code', $data['referral_code'])->firstOrFail();

        unset($data['referral_code']);
        $data['referred_by'] = $referrer->id;

        return $this->getUserModel()::create($data);
    }
}
