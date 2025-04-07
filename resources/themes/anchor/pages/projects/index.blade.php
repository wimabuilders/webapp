<?php

use App\Models\Property;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('projects.index');
?>

@php
    $projects = auth()->user()->projects()->paginate(9);
@endphp

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <div class="flex justify-between items-center">
            <x-app.heading
                title="Projects"
                :border="false"
            />
            <x-button tag="a" href="{{ route('projects.create') }}">New Project</x-button>
        </div>

        <div class="grid grid-cols-3 gap-8">
            @foreach ($projects as $project)
                <x-project-card :project="$project"/>
            @endforeach
        </div>

        {{ $projects->links() }}
    </x-app.container>
</x-layouts.app>
