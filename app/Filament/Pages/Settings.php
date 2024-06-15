<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Panel\Concerns\HasNotifications;

class Settings extends Page
{
    use InteractsWithForms, HasNotifications;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $referralPercentage = (float) Setting::where('key', Setting::REFERRAL_BONUS_PERCENTAGE)->first()->value;
        $autoWithdrawalUpToAmount = (int) Setting::where('key', Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT)->first()->value;
        $newUsersCannotWithdrawForXDays = (int) Setting::firstOrCreate(
            ['key' => Setting::NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS],
            ['value' => 3]
        )->value;

        $this->form->fill([
            Setting::REFERRAL_BONUS_PERCENTAGE => $referralPercentage,
            Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT => $autoWithdrawalUpToAmount,
            Setting::NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS => $newUsersCannotWithdrawForXDays,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form;
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        TextInput::make(Setting::REFERRAL_BONUS_PERCENTAGE)
                            ->numeric()
                            ->postfix('%')
                            ->label('Referral Percentage')
                            ->helperText('% of the amount the referrer wins when the referred user deposits. For example if the user deposits 100 USDT and the referral percentage is 1%, the referrer will get 1 USDT.')
                            ->placeholder('0.00')
                            ->required()
                            ->rules(['numeric', 'min:0', 'max:100', 'regex:/^\d+(\.\d{1,2})?$/'])
                            ->default('1.00'),
                        TextInput::make(Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT)
                            ->numeric()
                            ->postfix('USDT')
                            ->label('Automatic withdrawal up to amount')
                            ->helperText('The amount that users can withdraw automatically without admin approval. If the withdrawal amount is less than or equal to this amount, it will be processed automatically. If the withdrawal amount is greater than this amount, it will require admin approval.')
                            ->placeholder('0.00')
                            ->required()
                            ->rules(['numeric', 'min:0', 'max:500'])
                            ->default(30),
                        TextInput::make(Setting::NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS)
                            ->numeric()
                            ->postfix('days')
                            ->label('How many days should new users wait before they can withdraw?')
                            ->placeholder('3')
                            ->required()
                            ->rules(['numeric', 'min:0', 'max:30'])
                            ->default(3),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function create(): void
    {
        $data = $this->form->getState();

        Setting::where('key', Setting::REFERRAL_BONUS_PERCENTAGE)
            ->update(['value' => (float) $data[Setting::REFERRAL_BONUS_PERCENTAGE]]);

        Setting::where('key', Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT)
            ->update(['value' => (float) $data[Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT]]);

        Setting::where('key', Setting::NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS)
            ->update(['value' => (float) $data[Setting::NEW_USERS_CANNOT_WITHDRAW_FOR_X_DAYS]]);

        Notification::make()
            ->title('Success')
            ->success()
            ->send();
    }

    protected function getActions(): array
    {
        return [
            $this->getDisableWithdrawalsForAllUsersAction(),
            $this->getDisableTheWholeAppAction(),
        ];
    }

    protected function getDisableWithdrawalsForAllUsersAction(): Action
    {
        return Action::make('disable_withdrawals_for_all_users')
            ->color('danger')
            ->sendSuccessNotification()
            ->label('Disable withdrawals for all users')
            ->requiresConfirmation()
            ->action(function() {
                User::query()->update(['can_withdraw' => false]);

                Notification::make()
                    ->title('Success')
                    ->success()
                    ->send();
            });
    }

    protected function getDisableTheWholeAppAction(): Action
    {
        $clientAppIsLive = (bool) Setting::where('key', Setting::CLIENT_APP_IS_LIVE)->first()->value;

        return Action::make('disable_the_whole_app')
            ->color('danger')
            ->sendSuccessNotification()
            ->label($clientAppIsLive ? 'Disable app' : 'Enable app')
            ->requiresConfirmation()
            ->action(function() use($clientAppIsLive) {
                Setting::where('key', Setting::CLIENT_APP_IS_LIVE)
                    ->update(['value' => !$clientAppIsLive]);

                Notification::make()
                    ->title('Success')
                    ->success()
                    ->send();
            });
    }
}
