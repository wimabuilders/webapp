<?php

namespace App\Forms;

use App\Models\PropertyType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\RawJs;

class PropertyForm
{
    public static function schema(): array
    {
        $canSetFeatured = request()->user()->checkPermissionTo('feature property');

        return [
            Grid::make('PropertyForm')->schema([
                TextInput::make('title')
                    ->columnSpan(2)
                    ->maxLength(191)
                    ->placeholder('Eg. 3 Bedroom House at East Legon.')
                    ->required(),
                TextInput::make('city')
                    ->columnSpan(2)
                    ->maxLength(191)
                    ->placeholder('Eg. East Legon')
                    ->required(),
                TextInput::make('location')
                    ->columnSpan(2)
                    ->placeholder('Eg. American house behind the mall.')
                    ->maxLength(191)
                    ->required(),
                TextInput::make('bed')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->minValue(1),
                TextInput::make('bath')
                    ->numeric()
                    ->required(),
                TextInput::make('sqft')
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('Ghc'),
                TextInput::make('lat')
                    ->placeholder('Latitude')
                    ->numeric()
                    ->default(null),
                TextInput::make('long')
                    ->placeholder('Longitude')
                    ->numeric()
                    ->default(null),
                Select::make('property_type_id')
                    ->label('Property Type')
                    ->options(PropertyType::pluck('name', 'id')->toArray())
                    ->required(),
                TextInput::make('year')
                    ->placeholder('YYYY')
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(2030),
                Select::make('features')
                    ->columnSpan(2)
                    ->multiple()
                    ->preload()
                    ->relationship(titleAttribute: 'name'),
                Select::make('tags')
                    ->columnSpan(2)
                    ->multiple()
                    ->preload()
                    ->relationship(titleAttribute: 'name'),
                Grid::make('Toggles')->schema([
                    Select::make('for_rent')
                        ->label("Rent / Sale")
                        ->options([
                            0 => "For sale",
                            1 => "For rent",
                        ])
                        ->required(),
                    ...($canSetFeatured ? [
                        Toggle::make('featured')
                    ] : []),
                ])->columns(6),
                SpatieMediaLibraryFileUpload::make('images')
                    ->label('Property images (drag to order)')
                    ->disk('s3')
                    ->multiple()
                    ->reorderable()
                    ->columnSpan('3')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight(250)
                    ->imageResizeTargetWidth('1080')
                    ->imageEditorMode(2)
                    ->panelLayout('grid')
                    ->required()
            ])->columns(6)
        ];
    }
}
