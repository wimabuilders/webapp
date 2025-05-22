<article class="flex flex-col relative rounded-lg shadow-2xl bg-white dark:bg-neutral-800">
    <div class="relative w-full min-h-[15rem] pt-[56.25%] overflow-hidden rounded-lg text-white">
        <img class="absolute top-0 w-full h-full object-cover"
             src="{{ $product->getFirstPropertyImage() }}" loading="lazy"
             alt="">
        <div
            class="flex flex-col justify-between w-full h-full absolute top-0 p-4 bg-gradient-to-t from-black via-black/75 to-transparent">
            <div class="flex gap-3 justify-between items-start">
                <div class="flex gap-1">
                    <span
                        class="flex gap-1 items-center text-sm overflow-hidden px-2 py-1 rounded bg-white text-neutral-900">
                        <span>{{ $product->status }}</span>
                    </span>
                </div>
            </div>
            <div class="flex flex-col mt-auto pt-4">
                <div class="flex gap-3 justify-between">
                    <div class="text-start">
                        <h4 class="text-lg font-bold leading-6 line-clamp-2">{{ $product->title }}</h4>
                        <div class="text-sm text-gray-500 mt-2">{{ $product->city }}</div>
                    </div>
                </div>
                <div class="flex mt-1 justify-between items-center">
                    <span
                        class="text-md font-extrabold">{{ $product->price ? 'Ghc ' . money($product->price) : '' }}</span>
                    <div class="flex gap-2">
                        <a href="{{ route('products.edit', ['product' => $product]) }}">
                            <x-heroicon-s-pencil class="p-1 h-7 w-7 text-blue-600"/>
                        </a>

                        <form id="delete-form-{{ $product->id }}" method="POST"
                              action="{{ route('products.destroy', $product) }}">
                            @csrf @method('DELETE')
                            <button
                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) { document.getElementById('delete-form-{{ $product->id }}').submit(); }">
                                <x-heroicon-s-trash class="p-1 h-7 w-7 text-red-600"/>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
