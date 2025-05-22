<?php

use App\Models\Product;

use function Laravel\Folio\{middleware, name};

middleware('auth');
name('products.create');

$product = new Product();
?>

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6 max-w-6xl" x-cloak>
        <x-app.heading
            title="Add Product"
            :border="false"
        />
        <livewire:product-manager :product="$product" :create="true"/>
    </x-app.container>
</x-layouts.app>
