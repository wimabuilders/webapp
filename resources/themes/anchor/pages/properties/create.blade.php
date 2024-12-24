<?php

    use App\Models\Property;

    use function Laravel\Folio\{middleware, name};
	middleware('auth');
    name('properties.edit');

    $property = new Property();
?>

<x-layouts.app>
	<x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Add Property"
            :border="false"
        />
        <livewire:property-manager :property="$property" :create="true" />
    </x-app.container>
</x-layouts.app>
