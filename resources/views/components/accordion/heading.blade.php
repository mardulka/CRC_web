@props(['link', 'id', 'expanded' => 'false'])

<div id="{{$id}} " class="pb-2 pt-6">
    <button type="button"
            class="flex items-center justify-between w-full p-2 rounded-lg font-medium bg-gray-100 text-lg lg:text-xl text-left border-2 border-gray-400
            text-gray-600 focus:hover:bg-yellow-100 focus:hover:border-yellow-600 focus:hover:text-yellow-600"
            data-accordion-target="{{'#'.$link}}" aria-expanded="{{$expanded}}" aria-controls="{{$link}}">
        <span>{{$slot}}</span>
        <svg data-accordion-icon class="w-6 h-6 shrink-0 rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
