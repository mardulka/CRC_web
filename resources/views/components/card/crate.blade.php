<div class="block">
    <div class="bg-gradient-to-r from-red-300 to-white rounded-md">
        <div class="p-1.5">
            {{ $name }}
        </div>
    </div>

    <div class="container mx-auto p-8">
        <div class="flex flex-row flex-wrap -mx-2">
            {{ $slot }}
        </div>
    </div>
</div>
