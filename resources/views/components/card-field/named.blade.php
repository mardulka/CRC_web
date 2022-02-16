@props(['heading', 'gap' => 'gap-4', 'link' => '#'])

<div class="text-gray-600 mt-2 w-full border border-gray-300 rounded-lg md:mt-4">
    <div class="flex items-center justify-between w-full p-2 rounded-t-lg font-medium bg-gray-100 text-lg lg:text-xl text-left border-2 ">
        {{$heading}}
    </div>
    <div class="p-1 md:p-3 flex flex-wrap {{$gap}}">
        {{$slot}}
    </div>
</div>
