<?php

use App\Models\Product;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('products.edit');

// Abort if the user doesn't own the product
?>

@php
    // probably redirect user to the products page with a message
    if (auth()->id() !== $product->user_id) abort(403, 'Unauthorized action.');
@endphp

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Edit Product"
            :border="false"
        />
        <livewire:product-manager :product="$product"/>
    </x-app.container>
</x-layouts.app>
