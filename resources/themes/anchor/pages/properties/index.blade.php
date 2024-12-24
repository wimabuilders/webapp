<?php

    use App\Models\Property;

    use function Laravel\Folio\{middleware, name};
	middleware('auth');
    name('properties.index');
?>

@php
    $properties = auth()->user()->properties()->paginate(9);
@endphp

<x-layouts.app>
	<x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>

        <div class="flex justify-between items-center">
            <x-app.heading
                title="My Properties"
                description="Here, you can manage your properties by adding, editing or deleting them."
                :border="false"
            />
            <x-button tag="a" href="/properties/create">New Property</x-button>
        </div>

        <div class="grid grid-cols-3 gap-8">
            @foreach ($properties as $property)
                <x-property-card :property="$property" />
            @endforeach
        </div>

        {{ $properties->links() }}
    </x-app.container>
</x-layouts.app>
