<?php

    use App\Models\Property;

    use function Laravel\Folio\{middleware, name};
    middleware('auth');
    name('properties.edit');

    // Abort if the user doesn't own the property
?>

@php
    // probably redirect user to the properties page with a message
    if (auth()->id() !== $property->user_id) abort(403, 'Unauthorized action.');
@endphp

<x-layouts.app>
	<x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Edit Property"
            :border="false"
        />
        <livewire:property-manager :property="$property" />
    </x-app.container>
</x-layouts.app>
