<x-app-layout>
    <x-element.content-box>

        <x-element.basic-navigation>
            <x-element.back-button>
                <x-slot name="link">{{ $url = route('championship', ['id' => $championship->championship_id]) }}</x-slot>
                {{$championship->description}}
            </x-element.back-button>
            >
            <x-element.back-button>
                <x-slot name="link">{{ $url = route('race', ['id' => $race->race_id]) }}</x-slot>
                {{ $race->name }}
            </x-element.back-button>
        </x-element.basic-navigation>

        <x-element.site-headline>
            {{ $practice->name }}
        </x-element.site-headline>

        <div class="text-2xl p-4 bg-yellow-300">
            Tady bude tabulka atributů.
        </div>

        <div class="text-2xl p-4 bg-green-300">
            Tady budou výsledky.
        </div>

    </x-element.content-box>
</x-app-layout>
