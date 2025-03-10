<?php

use App\Models\Property;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('professions.edit');
// Abort if the user doesn't own the profession
?>

@php
    // probably redirect user to the professions page with a message
    if (auth()->id() !== $professionUser->user_id) abort(403, 'Unauthorized action.');
@endphp

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Edit Professionp"
            :border="false"
        />
        <livewire:profession-manager :profession="$professionUser"/>
    </x-app.container>
</x-layouts.app>
