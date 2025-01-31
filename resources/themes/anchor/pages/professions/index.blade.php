<?php

use App\Models\Property;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('professions.index');
?>

@php
    $professions = auth()->user()->professions()->paginate(9);
@endphp

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>

        <div class="flex justify-between items-center">
            <x-app.heading
                title="My Properties"
                description="Here, you can manage your professions by adding, editing or deleting them."
                :border="false"
            />
            <x-button tag="a" href="/professions/create">New Profession</x-button>
        </div>

        {{--        <div class="grid grid-cols-3 gap-8">--}}
        {{--            @foreach ($professions as $profession)--}}
        {{--                <x-profession-card :profession="$profession"/>--}}
        {{--            @endforeach--}}
        {{--        </div>--}}

        {{ $professions->links() }}
    </x-app.container>
</x-layouts.app>
