<x-filament-panels::page>
    <div>
        <form wire:submit="create">
            {{ $this->form }}

            <br>
            <x-filament::button type="submit">Change password</x-filament::button>
        </form>

        <x-filament-actions::modals />
    </div>
</x-filament-panels::page>
