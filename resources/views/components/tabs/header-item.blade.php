@props(['status' => '', 'link'])

<li class="mr-2" role="presentation">
    <button
        class="inline-block p-4 text-sm font-medium text-center text-gray-500 border-b-2 border-transparent hover:text-yellow-500 hover:border-yellow-500 {{$status}}"
        id="dashboard-tab" data-tabs-target="{{"#".$link}}" type="button" role="tab" aria-controls="dashboard" aria-selected="true">
        {{$slot}}
    </button>
</li>
