<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LevelResource\Pages;
use App\Filament\Resources\LevelResource\RelationManagers;
use App\Models\Level;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LevelResource extends Resource
{
    protected static ?string $model = Level::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('rank')
                    ->label('Rank (1 is first, 2 is second, etc.)')
                    ->minValue(1)
                    ->maxValue(1000000)
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('upgrade_cost')
                    ->numeric()
                    ->postfix('USDT')
                    ->minValue(1)
                    ->maxValue(1000000)
                    ->required(),
                Forms\Components\TextInput::make('daily_return_amount')
                    ->numeric()
                    ->minValue(1)
                    ->postfix('USDT')
                    ->maxValue(1000000)
                    ->required(),
                Forms\Components\TextInput::make('claim_limit')
                    ->label('For how many days can the user claim the daily return?')
                    ->required()
                    ->postfix('times')
                    ->minValue(1)
                    ->maxValue(1000)
                    ->numeric(),
                Forms\Components\TextInput::make('required_referrals_count')
                    ->label('How many friends need to be in the previous level to unlock this level?')
                    ->minValue(0)
                    ->maxValue(1000)
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('rank')
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->numeric(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('upgrade_cost')
                    ->suffix(' USDT'),
                Tables\Columns\TextColumn::make('daily_return_amount')
                    ->suffix(' USDT'),
                Tables\Columns\TextColumn::make('claim_limit')
                    ->suffix('x')
                    ->numeric(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListLevels::route('/'),
            'create' => Pages\CreateLevel::route('/create'),
            'edit' => Pages\EditLevel::route('/{record}/edit'),
        ];
    }
}
