<div class="w-full sm:w-1/4 md:w-1/4 mb-4 px-2">
    <div class="relative bg-white rounded-lg border">
        <picture class="block bg-gray-200 border-b">
            <a class="stretched-link" href="{{ $link ?? '#' }}" title="">
                <img class="block" src="https://via.placeholder.com/800x600/EDF2F7/E2E8F0/&amp;text=Card" alt="Card">
            </a>
        </picture>
        <div class="p-4">
            <h3 class="text-xl font-bold">
                <a class="stretched-link" href="{{ $link ?? '#' }}" title="">
                    {{ $name }}
                </a>
            </h3>
            <div class="block mb-2 text-sm text-gray-600">
                {{ $info }}
            </div>
            <p>
                {{ $slot }}
            </p>
        </div>
    </div>
</div>
