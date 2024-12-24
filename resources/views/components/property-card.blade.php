<article class="flex flex-col relative rounded-lg shadow-2xl bg-white dark:bg-neutral-800">
    <div class="relative w-full min-h-[15rem] pt-[56.25%] overflow-hidden rounded-lg text-white">
        <img class="absolute top-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=640&h=480&crop=entropy" loading="lazy" alt="">
        <div class="flex flex-col justify-between w-full h-full absolute top-0 p-4 bg-gradient-to-t from-black via-black/75 to-transparent">
            <div class="flex gap-3 justify-between items-start">
                <div class="flex gap-1">
                    <span class="flex gap-1 items-center text-sm overflow-hidden px-2 py-1 rounded bg-white text-neutral-900">
                        <span>For {{ $property->for_rent ? 'rent' : 'sale' }}</span>
                    </span>
                </div>
                <!-- <label class="ml-auto rounded-full cursor-pointer" aria-label="Favorite">
                    <input type="checkbox" class="peer sr-only">
                    <span class="group flex items-center justify-center w-9 h-9 rounded-full bg-white">
                        <i class="icon-[heroicons--heart-solid] w-5 h-5 text-neutral-500 peer-checked:text-red-600"></i>
                    </span>
                </label> -->
            </div>
            <div class="flex flex-col mt-auto pt-4">
                <!-- <div class="flex gap-1 mb-3">
                    <span class="flex items-center text-sm px-2 py-1 rounded bg-white text-neutral-900">
                        <span>Villa</span>
                    </span>
                    <span class="flex items-center text-sm px-2 py-1 rounded bg-white text-neutral-900">
                        <span>Fully Furnished</span>
                    </span>
                </div> -->
                <div class="flex gap-3 justify-between">
                    <div class="text-start">
                        <h4 class="text-lg font-bold leading-6 line-clamp-2">{{ $property->title }}</h4>
                        <div class="text-sm text-gray-500 mt-2">{{ $property->city }}</div>
                    </div>
                </div>
                <div class="flex mt-1 justify-between items-center">
                    <span class="text-md font-extrabold">Ghc {{ money($property->price) }}</span>
                    <div class="flex gap-2">
                        <a href="{{ route('properties.edit', ['property', $property]) }}">
                            <x-heroicon-s-pencil class="p-1 h-7 w-7 text-blue-600" />
                        </a>
                        <x-heroicon-s-trash class="p-1 h-7 w-7 text-red-600" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
