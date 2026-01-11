<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-folder';
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('category')
                            ->maxLength(255)
                            ->placeholder('e.g., Web App, Mobile App'),
                        TagsInput::make('tags')
                            ->label('Tags')
                            ->placeholder('Tambah tag lalu tekan Enter')
                            ->helperText('Contoh: Laravel, React, Tailwind'),
                        Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->label('Gambar Utama')
                            ->image()
                            ->disk('public')
                            ->directory('projects')
                            ->imageEditor(),
                        FileUpload::make('gallery')
                            ->label('Gallery (Maks 3)')
                            ->image()
                            ->disk('public')
                            ->directory('projects/gallery')
                            ->multiple()
                            ->maxFiles(3)
                            ->reorderable()
                            ->imageEditor(),
                        TextInput::make('link')
                            ->label('Live Link')
                            ->url()
                            ->placeholder('https://example.com'),
                        TextInput::make('github_link')
                            ->label('GitHub Link')
                            ->url()
                            ->placeholder('https://github.com/...'),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->helperText('Show on homepage'),
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
                Tables\Columns\ImageColumn::make('image')
                    ->size(80),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\TernaryFilter::make('is_featured'),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
