<?php

namespace App\Filament\Resources\Sekolahs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class SekolahsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('nama')->label('Nama Sekolah')->searchable()->sortable(),
                \Filament\Tables\Columns\TextColumn::make('tahun_masuk')->label('Masuk')->sortable(),
                \Filament\Tables\Columns\TextColumn::make('tahun_lulus')->label('Lulus')->sortable(),
                \Filament\Tables\Columns\TextColumn::make('jurusan')->label('Jurusan')->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('pernah_menjadi_apa')->label('Pernah Menjadi Apa')->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\IconColumn::make('aktif')->boolean()->label('Aktif')->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\TernaryFilter::make('aktif')->label('Tampilkan di Home'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
