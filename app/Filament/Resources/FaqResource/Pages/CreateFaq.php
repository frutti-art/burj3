<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFaq extends CreateRecord
{
    protected static string $resource = FaqResource::class;

    public static function canCreateAnother(): bool
    {
        return false;
    }
}
