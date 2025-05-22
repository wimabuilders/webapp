<?php

use App\Models\Property;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('products.index');
?>

@php
    $products = auth()->user()->products()->paginate(9);
@endphp

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <div class="flex justify-between items-center">
            <x-app.heading
                title="Products"
                :border="false"
            />
            <x-button tag="a" href="{{ route('products.create') }}">New Product</x-button>
        </div>

        <div class="grid grid-cols-3 gap-8">
            @foreach ($products as $product)
                <x-product-card :product="$product"/>
            @endforeach
        </div>

        {{ $products->links() }}
    </x-app.container>
</x-layouts.app>
