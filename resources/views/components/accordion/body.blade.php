@props(['id', 'linked_by', 'status' =>'hidden'])

<div id="{{$id}}" aria-labelledby="{{$linked_by}}" class="{{$status}}" >
    {{$slot}}
</div>
