<?php

namespace Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class CustomRegister extends Register
{

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

    private function getReferralCodeFormComponent()
    {
        return TextInput::make('referral_code')
            ->label('Referral code')
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
