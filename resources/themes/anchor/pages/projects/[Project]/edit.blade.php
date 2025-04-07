<?php

use App\Models\Project;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('projects.edit');

// Abort if the user doesn't own the project
?>

@php
    // probably redirect user to the projects page with a message
    if (auth()->id() !== $project->user_id) abort(403, 'Unauthorized action.');
@endphp

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Edit Project"
            :border="false"
        />
        <livewire:project-manager :project="$project"/>
    </x-app.container>
</x-layouts.app>
