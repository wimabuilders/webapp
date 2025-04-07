<?php

namespace App\Livewire;

use App\Forms\ProjectForm;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ProjectManager extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Project $project;

    public $create = false;
    public $user_id;
    public $loading = false;

    public function mount(): void
    {
        $this->user_id = auth()->id();
        $this->form->fill($this->project->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(ProjectForm::schema())
            ->statePath('data')
            ->model($this->project);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        // $this->loading = true; TODO: fix the loading display

        if ($this->create) {
            $this->project = Project::create([...$data, 'user_id' => $this->user_id]);
            $this->form->model($this->project)->saveRelationships();
        } else {
            $this->project->update($data);
        }

        $this->redirectRoute('projects.index');

        Notification::make()
            ->title("Project successfully " . ($this->create ? "created." : "updated."))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.project-manager');
    }
}
