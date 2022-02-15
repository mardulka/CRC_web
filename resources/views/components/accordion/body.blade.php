@props(['id', 'linked_by'])

<div id="{{$id}}" aria-labelledby="{{$linked_by}}" class="hidden" >
    {{$slot}}
</div>
