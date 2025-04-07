<?php

use App\Models\Project;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('projects.create');

$project = new Project();
?>

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Add Project"
            :border="false"
        />
        <livewire:project-manager :project="$project" :create="true"/>
    </x-app.container>
</x-layouts.app>
