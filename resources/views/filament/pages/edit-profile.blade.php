<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Profile Form --}}
        <form wire:submit="updateProfile">
            {{ $this->profileForm }}

            <div class="flex justify-end mt-4">
                <x-filament::button type="submit">
                    Simpan Profil
                </x-filament::button>
            </div>
        </form>

        {{-- Password Form --}}
        <form wire:submit="updatePassword">
            {{ $this->passwordForm }}

            <div class="flex justify-end mt-4">
                <x-filament::button type="submit">
                    Ubah Password
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament-panels::page>