<?php

namespace App\Livewire;

use App\Forms\PropertyForm;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class PropertyManager extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Property $property;

    public $create = false;

    public function mount(): void
    {
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

        if ($this->create) $this->property = Property::create([...$data, 'user_id' => auth()->id()]);
        else $this->property->update($data);

        $this->redirectRoute('properties.index');
    }

    public function render(): View
    {
        return view('livewire.property-manager');
    }
}
