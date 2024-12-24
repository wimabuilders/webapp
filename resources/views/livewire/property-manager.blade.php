<div class="pt-4">
    <form wire:submit="save">
        {{ $this->form }}
        <x-filament::button class="mt-12" type="submit">{{ $this->create ? 'Submit' : 'Update'}} Property</x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
