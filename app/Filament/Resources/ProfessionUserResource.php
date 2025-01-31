<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionUserResource\Pages;
use App\Filament\Resources\ProfessionUserResource\RelationManagers;
use App\Models\ProfessionUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfessionUserResource extends Resource
{
    protected static ?string $model = ProfessionUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('profession_id')
                    ->label('Profession')
                    ->relationship('profession', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Textarea::make('bio')->label('Bio')->nullable(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('cert')
                    ->label('Professional Certificate')
                    ->downloadable()
                    ->maxSize(10240)
                    ->collection('certs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('s3')
                    ->visibility('public')
                    ->required(),
                Forms\Components\TextInput::make('experience')
                    ->label('Years of Experience')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_primary')
                    ->label('Primary Profession')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('profession.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('experience')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('cert')
                    ->label('Certification')
                    ->url(fn($record) => $record->cert, true)
                    ->formatStateUsing(fn($state) => 'Certificate')
                    ->icon('heroicon-o-link') // Adds a link icon
                    ->color('primary')
                    ->tooltip('View certifications')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProfessionUsers::route('/'),
        ];
    }
}
