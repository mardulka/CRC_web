@props(['status' => '', 'id'])

<div class="{{$status}}" id="{{$id}}" role="tabpanel" aria-labelledby="{{$id.'-tab'}}">
    <div class="container mx-auto p-2 md:p-8">
        {{$slot}}
    </div>
</div>
