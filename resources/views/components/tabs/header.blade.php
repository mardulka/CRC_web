@props(['link'])

<div class="mb-2 border-b border-gray-200">
    <ul class="flex flex-wrap mb-px" id="myTab" data-tabs-toggle="{{"#".$link}}" role="tablist">
        {{$slot}}
    </ul>
</div>
