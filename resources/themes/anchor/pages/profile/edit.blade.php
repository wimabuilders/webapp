<?php

use App\Forms\ProfileForm;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

middleware(['auth', 'verified']);
name('profile.edit');

new class extends Component implements HasForms {
    use InteractsWithForms;

    public ?array $data = [];
    public $user;

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->form->fill($this->user->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(ProfileForm::schema())
            ->statePath('data')
            ->model(auth()->user());
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->user->update($data);

        Notification::make()
            ->title("Profile updated successfully.")
            ->success()
            ->send();
    }
}
?>

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6" x-cloak>
        <x-app.heading
            title="Update profile"
            description="Manage your account details."
        />
        @volt('profile.edit')
        <form wire:submit="save" class="space-y-5">
            {{ $this->form }}
            <x-filament::button class="mt-12" type="submit">
                <div class="flex items-center gap-2">
                    Update Profile
                </div>
            </x-filament::button>
        </form>
        @endvolt
    </x-app.container>
</x-layouts.app>
