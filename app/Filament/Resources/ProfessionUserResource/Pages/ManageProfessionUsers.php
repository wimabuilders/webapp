<?php

namespace App\Filament\Resources\ProfessionUserResource\Pages;

use App\Filament\Resources\ProfessionUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProfessionUsers extends ManageRecords
{
    protected static string $resource = ProfessionUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
