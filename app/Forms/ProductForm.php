<?php

namespace App\Forms;

use App\Models\ProductCategory;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\RawJs;

class ProductForm
{
    public static function schema(): array
    {
        $canSetFeatured = request()->user()->checkPermissionTo('feature property');

        return [
            Grid::make('ProductForm')->schema([
                TextInput::make('title')
                    ->columnSpan(2)
                    ->maxLength(191)
                    ->placeholder('Enter name of product.')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('Ghc'),
                Select::make('product_category_id')
                    ->label('Product Category')
                    ->options(ProductCategory::pluck('name', 'id')->toArray())
                    ->required(),
                Toggle::make('isAvailable')
                    ->label('In stock?')
                    ->inline(false)
                    ->default(true),
                Textarea::make('description')
                    ->columnSpan(3)
                    ->placeholder('Enter product description')
                    ->rows(3)
                    ->required(),
                SpatieMediaLibraryFileUpload::make('images')
                    ->label('Product images (drag to order)')
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
