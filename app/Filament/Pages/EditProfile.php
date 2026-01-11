<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.edit-profile';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-user-circle';
    }

    public static function getNavigationLabel(): string
    {
        return 'Edit Profile';
    }

    public function getTitle(): string
    {
        return 'Edit Profile';
    }

    public static function getSlug(?Panel $panel = null): string
    {
        return 'edit-profile';
    }

    public static function getNavigationSort(): ?int
    {
        return 100;
    }

    public ?array $profileData = [];
    public ?array $passwordData = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->profileForm->fill([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    protected function getProfileFormSchema(): array
    {
        return [
            Section::make('Informasi Profil')
                ->description('Update informasi profil dan email Anda.')
                ->schema([
                    TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->unique('users', 'email', ignorable: Auth::user()),
                ]),
        ];
    }

    protected function getPasswordFormSchema(): array
    {
        return [
            Section::make('Ubah Password')
                ->description('Masukkan password baru Anda.')
                ->schema([
                    TextInput::make('current_password')
                        ->label('Password Saat Ini')
                        ->password()
                        ->required()
                        ->currentPassword(),
                    TextInput::make('password')
                        ->label('Password Baru')
                        ->password()
                        ->required()
                        ->different('current_password'),
                    TextInput::make('password_confirmation')
                        ->label('Konfirmasi Password Baru')
                        ->password()
                        ->required()
                        ->same('password'),
                ]),
        ];
    }

    protected function getForms(): array
    {
        return [
            'profileForm' => $this->makeSchema()
                ->components($this->getProfileFormSchema())
                ->statePath('profileData'),
            'passwordForm' => $this->makeSchema()
                ->components($this->getPasswordFormSchema())
                ->statePath('passwordData'),
        ];
    }

    public function updateProfile(): void
    {
        $data = $this->profileForm->getState();

        $user = Auth::user();
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        Notification::make()
            ->title('Profil berhasil diperbarui!')
            ->success()
            ->send();
    }

    public function updatePassword(): void
    {
        $data = $this->passwordForm->getState();

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        $this->passwordData = [];

        Notification::make()
            ->title('Password berhasil diubah!')
            ->success()
            ->send();
    }
}
