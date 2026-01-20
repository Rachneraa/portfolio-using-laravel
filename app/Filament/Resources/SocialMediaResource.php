<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialMediaResource\Pages;
use App\Models\SocialMedia;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SocialMediaResource extends Resource
{
    protected static ?string $model = SocialMedia::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-share';
    }

    public static function getNavigationSort(): ?int
    {
        return 6;
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Social Media')
                    ->schema([
                        Select::make('icon')
                            ->options(SocialMedia::getAvailableIcons())
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn($state, $set) => $set('name', SocialMedia::getAvailableIcons()[$state] ?? '')),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('url')
                            ->required()
                            ->url()
                            ->placeholder('https://instagram.com/username'),
                        ColorPicker::make('color')
                            ->default('#000000'),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Show on Website')
                            ->default(true)
                            ->helperText('Toggle to show/hide this social media icon'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => SocialMedia::getAvailableIcons()[$state] ?? $state),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->limit(30)
                    ->url(fn($record) => $record->url, true),
                Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Visible'),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Visibility'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialMedia::route('/'),
            'create' => Pages\CreateSocialMedia::route('/create'),
            'edit' => Pages\EditSocialMedia::route('/{record}/edit'),
        ];
    }
}
