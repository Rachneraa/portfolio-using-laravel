<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-user';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('About Section')
                    ->schema([
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('about')
                            ->imageEditor(),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
                Section::make('Gallery Images')
                    ->description('Upload 4 images for the about section gallery')
                    ->schema([
                        FileUpload::make('gallery_image_1')
                            ->image()
                            ->disk('public')
                            ->directory('about/gallery')
                            ->imageEditor()
                            ->label('Gallery Image 1'),
                        FileUpload::make('gallery_image_2')
                            ->image()
                            ->disk('public')
                            ->directory('about/gallery')
                            ->imageEditor()
                            ->label('Gallery Image 2'),
                        FileUpload::make('gallery_image_3')
                            ->image()
                            ->disk('public')
                            ->directory('about/gallery')
                            ->imageEditor()
                            ->label('Gallery Image 3'),
                        FileUpload::make('gallery_image_4')
                            ->image()
                            ->disk('public')
                            ->directory('about/gallery')
                            ->imageEditor()
                            ->label('Gallery Image 4'),
                    ])
                    ->columns(2),
                Section::make('What I Bring')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('order')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->default(true),
                            ])
                            ->columns(3)
                            ->orderColumn('order')
                            ->reorderable()
                            ->collapsible(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->html(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
