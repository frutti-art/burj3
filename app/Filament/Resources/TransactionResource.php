<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Setting;
use App\Models\Transaction;
use App\Services\TransactionService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ulid')
                    ->required(),
                Forms\Components\TextInput::make('transactionable_id')
                    ->numeric(),
                Forms\Components\TextInput::make('transactionable_type'),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount')
                    ->numeric(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('reference')
                    ->required(),
                Forms\Components\TextInput::make('wallet_address'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->suffix(' USDT')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wallet_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Accept')
                    ->requiresConfirmation()
                    ->action(function (Transaction $record) {
                        $transactionService = app()->make(TransactionService::class);
                        $transactionService->acceptWithdrawTransaction($record);
                    }),
                Tables\Actions\Action::make('Reject')
                    ->requiresConfirmation()
                    ->action(function (Transaction $record) {
                        $transactionService = app()->make(TransactionService::class);
                        $transactionService->rejectWithdrawTransaction($record);
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        $autoWithdrawalUpToAmount = (float) Setting::where('key', Setting::AUTO_WITHDRAWAL_UP_TO_AMOUNT)->first()->value;

        return parent::getEloquentQuery()
            ->where('amount', '>', $autoWithdrawalUpToAmount)
            ->where('type', Transaction::TYPE_WITHDRAW)
            ->where('reference', Transaction::REFERENCE_WITHDRAWAL)
            ->where('status', Transaction::STATUS_PENDING);
    }
}
