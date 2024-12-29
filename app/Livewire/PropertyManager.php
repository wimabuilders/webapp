<?php

namespace App\Livewire;

use App\Forms\PropertyForm;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class PropertyManager extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Property $property;

    public $create = false;
    public $user_id;
    public $loading = false;

    public function mount(): void
    {
        $this->user_id = auth()->id();
        $this->form->fill($this->property->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(PropertyForm::schema())
            ->statePath('data')
            ->model($this->property);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        // $this->loading = true; TODO: fix the loading display

        if ($this->create) {
            $this->property = Property::create([...$data, 'user_id' => $this->user_id]);
            $this->form->model($this->property)->saveRelationships();
        } else {
            $this->property->update($data);
        }

        $this->redirectRoute('properties.index');

        Notification::make()
            ->title("Property successfully " . ($this->create ? "created." : "updated."))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.property-manager');
    }
}
