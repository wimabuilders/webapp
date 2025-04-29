<?php

namespace App\Forms;

use App\Models\PropertyType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\RawJs;

class ProfessionForm
{
    public static function schema($front = false): array
    {
        $canSetFeatured = request()->user()->checkPermissionTo('feature property');

        return [
            Grid::make(['md' => 2])
                ->columns(2)
                ->schema([
                    Select::make('user_id')
                        ->label('User')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->hidden($front)
                        ->required(),
                    Select::make('profession_id')
                        ->label('Profession')
                        ->relationship('profession', 'name')
                        ->required(),
                    TextInput::make('experience')
                        ->label('Years of Experience')
                        ->required()
                        ->numeric(),
                    SpatieMediaLibraryFileUpload::make('cert')
                        ->label('Professional Certificate')
                        ->downloadable()
                        ->maxSize(10240)
                        ->collection('certs')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('s3')
                        ->visibility('public')
                        ->columnSpanFull(),
                ])->columnSpan(1),
            Grid::make([])
                ->schema([
                    Textarea::make('bio')
                        ->label('Bio')
                        ->rows(7)
                        ->required(),
                ])
                ->columnSpan(1)
            // Toggle::make('is_primary')
            //     ->label('Primary Profession')
            //     ->default(false)
        ];
    }
}
