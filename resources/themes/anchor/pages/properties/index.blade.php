<?php

use App\Models\Property;

    use function Laravel\Folio\{middleware, name};
	middleware('auth');
    name('properties');

    $properties = Property::paginate(9);
?>

<x-layouts.app>
	<x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <!-- <x-button tag="a" href="/projects/create">New Project</x-button> -->
        <div class="grid grid-cols-3 gap-8">
            @foreach ($properties as $property)
                <x-property-card :property="$property" />
            @endforeach
        </div>

        {{ $properties->links() }}
    </x-app.container>
</x-layouts.app>
