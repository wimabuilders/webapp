<?php

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('professions.index');
?>

@php
    $professions = auth()->user()->professionPivots()->paginate();
@endphp

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>

        <div class="flex justify-between items-center">
            <x-app.heading
                title="My Professional Profiles"
                description="Here, you can manage your professions by adding, editing or deleting them."
                :border="false"
            />
            <x-button tag="a" href="/professions/create">Add profession</x-button>
        </div>

        <div class="grid grid-cols-3 gap-8 text-sm">
            @foreach ($professions as $profession)
                <div class="border rounded p-8 pt-2 flex flex-col hover:shadow-lg">
                    <div class="self-end flex items-center justify-end -mr-4">
                        <a href="{{ route('professions.edit', ['professionUser' => $profession]) }}">
                            <x-heroicon-s-pencil class="p-1 pb-0 h-7 w-7 text-blue-600"/>
                        </a>
                        <form id="delete-form-{{ $profession->id }}" method="POST"
                              action="{{ route('professions.destroy', $profession) }}">
                            @csrf @method('DELETE')
                            <button
                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this profession?')) { document.getElementById('delete-form-{{ $profession->id }}').submit(); }">
                                <x-heroicon-s-trash class="p-1 pt-2 pb-0 h-7 w-7 text-red-600"/>
                            </button>
                        </form>
                    </div>
                    <h3 class="font-medium text-xl">{{ $profession->profession->name }}</h3>
                    <div class="flex mt-2">
                        <p class="flex items-center mr-16">
                            <x-heroicon-s-calendar class="h-5 w-5 mr-2"/> {{ $profession->experience }} years
                        </p>
                        @if($profession->getFirstMediaUrl('certs'))
                            <p class="flex items-center">
                                <x-heroicon-o-document class="h-5 w-5 mr-2"/>
                                <a href="{{ $profession->getFirstMediaUrl('certs') }}" class="underline">Cert</a>
                            </p>
                        @endif
                    </div>
                    <p class="line-clamp-3 mt-2">{{ $profession->bio }}</p>
                </div>
            @endforeach
        </div>

        {{ $professions->links() }}
    </x-app.container>
</x-layouts.app>
