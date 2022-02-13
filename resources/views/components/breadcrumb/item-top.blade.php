@props(['link' => '#'])

<li class="inline-flex items-center">
    <a href="{{$link}}" class="inline-flex items-center ">
        <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 hover:text-yellow-500 truncate">
        {{$slot}}
        </span>
    </a>
</li>
