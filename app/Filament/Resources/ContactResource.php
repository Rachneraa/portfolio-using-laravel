<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-envelope';
    }

    public static function getNavigationSort(): ?int
    {
        return 7;
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Messages';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::unread()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Message Details')
                    ->schema([
                        TextInput::make('name')
                            ->disabled(),
                        TextInput::make('email')
                            ->disabled(),
                        Textarea::make('message')
                            ->disabled()
                            ->rows(5)
                            ->columnSpanFull(),
                        Toggle::make('is_read')
                            ->label('Mark as Read'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label('Read'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Read Status'),
            ])
            ->actions([
                ViewAction::make(),
                Action::make('markAsRead')
                    ->icon('heroicon-o-check')
                    ->action(fn(Contact $record) => $record->update(['is_read' => true]))
                    ->hidden(fn(Contact $record) => $record->is_read),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('markAllAsRead')
                        ->icon('heroicon-o-check')
                        ->action(fn($records) => $records->each->update(['is_read' => true])),
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
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
}
