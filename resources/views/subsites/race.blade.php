<x-app-layout>
    <x-element.content-box>

        <x-element.basic-navigation>
            <x-element.back-button>
                <x-slot name="link">{{ $url = route('championship', ['id' => $championship->championship_id]) }}</x-slot>
                {{$championship->description}}
            </x-element.back-button>
        </x-element.basic-navigation>


        <x-element.site-headline>
            {{ $race->name }}
        </x-element.site-headline>

        <div class="text-2xl p-4 bg-yellow-300">
            Tady bude tabulka atributů.
        </div>

        <div class="text-2xl p-4 bg-green-300">
            Tady budou výsledky.
        </div>

        <x-card.crate>
            <x-slot name="name">Tréninky a kvalifikace</x-slot>
            @foreach($practices as $practice)
                    <x-card.card>
                        <x-slot name="name">{{ $practice->name }}</x-slot>
                        <x-slot name="info">{{ $practice->date}}</x-slot>
                        <x-slot name="link">{{ $url = route('practice', ['id' => $practice->practice_id]) }}</x-slot>
                    </x-card.card>
            @endforeach
            @foreach($qualifications as $qualification)
                <x-card.card>
                    <x-slot name="name">{{ $qualification->name }}</x-slot>
                    <x-slot name="info">{{ $qualification->date}}</x-slot>
                    <x-slot name="link">{{ $url = route('qualification', ['id' => $qualification->qualification_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
