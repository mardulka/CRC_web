@props(['id' => ''])

<div id="{{$id}}" data-accordion="open"
     data-active-classes="text-gray-600 hover:focus:bg-yellow-100 hover:focus:border-yellow-600 hover:focus:text-yellow-600"
     data-inactive-classes="text-gray-600 hover:focus:bg-yellow-100 hover:focus:border-yellow-600 hover:focus:text-yellow-600">
    {{$slot}}
</div>
