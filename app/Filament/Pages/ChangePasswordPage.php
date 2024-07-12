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
use Illuminate\Support\Facades\Artisan;

class ChangePasswordPage extends Page
{
    use InteractsWithForms, HasNotifications;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?int $navigationSort = 23;

    protected static ?string $navigationLabel = 'Change Password';

    protected static ?string $title = 'Change Password';

    public static function getRoutePath(): string
    {
        return '/change-password';
    }

    protected static string $view = 'filament.pages.change-password-page';

    public ?array $data = [];

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
                        TextInput::make('old_password')
                            ->password()
                            ->currentPassword()
                            ->label('Old Password')
                            ->placeholder('********')
                            ->required()
                            ->rules(['required', 'string', 'current_password']),
                        TextInput::make('new_password')
                            ->password()
                            ->confirmed()
                            ->label('New password')
                            ->placeholder('********')
                            ->required()
                            ->rules(['required', 'string', 'min:8', 'confirmed']),
                        TextInput::make('new_password_confirmation')
                            ->password()
                            ->label('New password confirmation')
                            ->placeholder('********')
                            ->required()
                            ->rules(['required', 'string', 'min:8']),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $user = auth()->user();
        $user->update([
            'password' => bcrypt($data['new_password']),
        ]);

        Notification::make()
            ->title('Success')
            ->success()
            ->send();
    }
}
