<?php

namespace App\Forms;

// use App\Models\ProjectType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\RawJs;

class ProjectForm
{
    public static function schema(): array
    {
        $canSetFeatured = request()->user()->checkPermissionTo('feature project');

        return [
            Grid::make('ProjectForm')->schema([
                TextInput::make('title')
                    ->columnSpan(2)
                    ->maxLength(191)
                    ->placeholder('Project title')
                    ->required(),
                TextInput::make('location')
                    ->columnSpan(2)
                    ->placeholder('Eg. American house behind the mall.')
                    ->maxLength(191)
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('Ghc'),
                TextInput::make('completion_date')
                    ->placeholder('YYYY')
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(2030),
                Select::make('status')
                    ->label('Project Status')
                    ->options([
                        'completed' => 'Completed',
                        'ongoing' => 'Ongoing',
                        'upcoming' => 'Upcoming',
                    ])
                    ->required(),
                // Select::make('features')
                //     ->label('Project Features')
                //     ->options([
                //         'swimming_pool' => 'Swimming Pool',
                //         'gym' => 'Gym',
                //         'garden' => 'Garden',
                //         'parking' => 'Parking',
                //         'security' => 'Security',
                //         'wifi' => 'Wifi',
                //     ])
                //     ->columnSpan(2)
                //     ->multiple()
                //     ->preload(),
                Textarea::make('description')
                    ->columnSpan(3)
                    ->rows(4)
                    ->maxLength(191)
                    ->placeholder('Eg. East Legon')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('images')
                    ->label('Project images (drag to order)')
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
            ])->columns(4)
        ];
    }
}
