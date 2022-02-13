@props(['status' => '', 'id'])

<div class="{{$status}}" id="{{$id}}" role="tabpanel" aria-labelledby="dashboard-tab">
    {{$slot}}
</div>
