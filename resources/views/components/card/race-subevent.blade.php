@props(['name', 'date', 'time', 'link' => '#'])

<div class="flex w-full items-center p-3 rounded-lg border border-gray-200 shadow-md bg-white hover:bg-gray-200 hover:ring-1 hover:ring-gray-700">
    <div class="flex flex-row flex-1 items-baseline px-1">
        <div class="text-base md:text-xl font-bold tracking-tight text-gray-900 px-2">{{$name}}</div>
        <div class="font-normal text-gray-700 text-sm md:text-base px-2">{{$date}}</div>
        <div class="font-normal text-gray-700 text-sm md:text-base px-2">{{$time}}</div>
    </div>
    <div class="px-1">
        <button class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-yellow-500">
            <a href="{{$link}}">Detail</a>
        </button>
    </div>
</div>
