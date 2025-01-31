<?php

namespace App\Forms;

use App\Models\PropertyType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\RawJs;

class ProfessionForm
{
    public static function schema(): array
    {
        $canSetFeatured = request()->user()->checkPermissionTo('feature property');

        return [
            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            Select::make('profession_id')
                ->label('Profession')
                ->relationship('profession', 'name')
                ->searchable()
                ->required(),
            Textarea::make('bio')->label('Bio')->nullable(),
            SpatieMediaLibraryFileUpload::make('cert')
                ->label('Professional Certificate')
                ->downloadable()
                ->maxSize(10240)
                ->collection('certs')
                ->acceptedFileTypes(['application/pdf'])
                ->disk('s3')
                ->visibility('public')
                ->required(),
            TextInput::make('experience')
                ->label('Years of Experience')
                ->required()
                ->numeric(),
            Toggle::make('is_primary')
                ->label('Primary Profession')
                ->default(false)
        ];
    }
}
