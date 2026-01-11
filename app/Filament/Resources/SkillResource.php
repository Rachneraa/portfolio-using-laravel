<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-wrench-screwdriver';
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Skill')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Radio::make('icon_type')
                            ->label('Icon Type')
                            ->options([
                                'emoji' => 'Emoji',
                                'image' => 'Image',
                            ])
                            ->default('emoji')
                            ->inline()
                            ->live()
                            ->required(),
                        TextInput::make('emoji')
                            ->label('Emoji')
                            ->placeholder('Ketik emoji, contoh: 🎨')
                            ->visible(fn($get) => $get('icon_type') === 'emoji')
                            ->maxLength(10),
                        FileUpload::make('icon')
                            ->label('Icon Image')
                            ->image()
                            ->disk('public')
                            ->directory('skills')
                            ->acceptedFileTypes(['image/svg+xml', 'image/png', 'image/jpeg', 'image/webp'])
                            ->visible(fn($get) => $get('icon_type') === 'image'),
                        ColorPicker::make('color')
                            ->label('Background Color')
                            ->default('#ec4899'),
                        Select::make('row')
                            ->options([
                                1 => 'Row 1 (Scroll Right)',
                                2 => 'Row 2 (Scroll Left)',
                            ])
                            ->default(1)
                            ->required(),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('emoji')
                    ->label('Emoji')
                    ->size('lg'),
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Image')
                    ->disk('public')
                    ->size(40)
                    ->checkFileExistence(false)
                    ->getStateUsing(function ($record) {
                        if ($record->icon) {
                            return asset('storage/' . $record->icon);
                        }
                        return null;
                    }),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon_type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'emoji' => 'info',
                        'image' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\TextColumn::make('row')
                    ->badge()
                    ->color(fn(int $state): string => match ($state) {
                        1 => 'success',
                        2 => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\SelectFilter::make('row')
                    ->options([
                        1 => 'Row 1',
                        2 => 'Row 2',
                    ]),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
