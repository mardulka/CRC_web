@props(['status' => '', 'link'])

<li class="mr-2" role="presentation">
    <button
        class="inline-block px-2 py-4 text-sm font-medium text-center text-gray-500 border-b-2 border-transparent hover:text-yellow-500 hover:border-yellow-500 {{$status}}"
        id="{{$link.'-tab'}}" data-tabs-target="{{"#".$link}}" type="button" role="tab" aria-controls="{{$link}}" aria-selected="true">
        {{$slot}}
    </button>
</li>
