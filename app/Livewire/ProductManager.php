<?php

namespace App\Livewire;

use App\Forms\ProductForm;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ProductManager extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Product $product;

    public $create = false;
    public $user_id;
    public $loading = false;

    public function mount(): void
    {
        $this->user_id = auth()->id();
        $this->form->fill($this->product->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(ProductForm::schema())
            ->statePath('data')
            ->model($this->product);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        // $this->loading = true; TODO: fix the loading display

        if ($this->create) {
            $this->product = Product::create([...$data, 'user_id' => $this->user_id]);
            $this->form->model($this->product)->saveRelationships();
        } else {
            $this->product->update($data);
        }

        $this->redirectRoute('products.index');

        Notification::make()
            ->title("Product successfully " . ($this->create ? "created." : "updated."))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.product-manager');
    }
}
