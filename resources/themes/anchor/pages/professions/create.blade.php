<?php

use App\Models\ProfessionUser;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('professions.create');

$profession = new ProfessionUser();
?>

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Add Profession"
            :border="false"
        />
        <livewire:profession-manager :profession="$profession" :create="true"/>
    </x-app.container>
</x-layouts.app>
