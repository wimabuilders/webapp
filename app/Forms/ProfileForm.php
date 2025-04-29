<?php

namespace App\Forms;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\RawJs;

class ProfileForm
{
    public static function schema(): array
    {
        return [
            Grid::make('UserForm')->schema([
                Toggle::make('isCompany')
                    ->label('Select if account is for a company')
                    ->columnSpanFull()
                    ->live()
                    ->inline(true),
                TextInput::make('name')
                    ->label(fn($get) => $get('isCompany') ? 'Company Name' : 'Name')
                    ->maxLength(191)
                    ->placeholder('Company name')
                    ->required(),
                TextInput::make('principal_name')
                    ->label('Principal Name')
                    ->hidden(fn($get) => !$get('isCompany'))
                    ->maxLength(191)
                    ->placeholder('Principal name')
                    ->required(),
                // Select::make('profession_id')
                //     ->label('Profession')
                //     ->relationship('profession', 'name')
                //     ->required(),
                // TextInput::make('experience')
                //     ->label(fn($get) => !$get('isCompany') ? 'Years of Experience' : 'Years of Operation')
                //     ->required()
                //     ->numeric(),
                TextInput::make('phone')
                    ->maxLength(191)
                    ->placeholder('Phone #')
                    ->required(),
                TextInput::make('address')
                    ->columnSpan(2)
                    ->maxLength(191)
                    ->placeholder('Address')
                    ->required(),
                TextInput::make('website')
                    ->maxLength(191)
                    ->placeholder('Website')
                    ->url(),
                RichEditor::make('bio')
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'bulletList', 'orderedList'
                    ])
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('cert')
                    ->label(fn($get) => !$get('isCompany') ? 'Professional Certificates' : 'Principal Certificate')
                    ->downloadable()
                    ->maxSize(10240)
                    ->collection('certs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('s3')
                    ->visibility('public'),
                SpatieMediaLibraryFileUpload::make('regcert')
                    ->label('Company Registration Certificate')
                    ->hidden(fn($get) => !$get('isCompany'))
                    ->downloadable()
                    ->maxSize(10240)
                    ->collection('certs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('s3')
                    ->visibility('public'),
            ])->columns(3)
        ];
    }
}
