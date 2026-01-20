<?php

namespace App\Filament\Resources\Sekolahs\Schemas;

use Filament\Schemas\Schema;

class SekolahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('nama')->required()->label('Nama Sekolah'),
                \Filament\Forms\Components\TextInput::make('tahun_masuk')->numeric()->required()->label('Tahun Masuk')->minValue(1900)->maxValue(2100),
                \Filament\Forms\Components\TextInput::make('tahun_lulus')->numeric()->required()->label('Tahun Lulus')->minValue(1900)->maxValue(2100),
                \Filament\Forms\Components\TextInput::make('jurusan')->label('Jurusan')->nullable(),
                \Filament\Forms\Components\Textarea::make('deskripsi')->required()->label('Deskripsi'),
                \Filament\Forms\Components\FileUpload::make('logo')
                    ->disk('public')
                    ->directory('sekolah')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth(200)
                    ->imageResizeTargetHeight(200)
                    ->maxSize(1024)
                    ->label('Logo (max 200x200px)'),
                \Filament\Forms\Components\ColorPicker::make('color')->label('Warna Timeline')->default('#A75F37'),
                \Filament\Forms\Components\Toggle::make('aktif')->label('Tampilkan di Home')->default(true),
                \Filament\Forms\Components\TextInput::make('pernah_menjadi_apa')->label('Pernah Menjadi Apa')->nullable(),
            ]);
    }
}
