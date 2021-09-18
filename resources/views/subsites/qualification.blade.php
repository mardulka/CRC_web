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
            {{ $qualification->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy a nastavení</x-slot>
            <div class="text-2xl p-4 bg-yellow-300">
                Tady bude tabulka atributů.
            </div>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Výsledky</x-slot>
            <x-table.qualify-result-header>
                @foreach($q_results as $result)
                    <x-table.qualify-result-row>
                        <x-slot name="position">{{ $loop->iteration }}</x-slot>
                        <x-slot name="name">{{ $result->first_name}} {{ $result->last_name }}</x-slot>
                        <x-slot name="team">{{ $result->team }}</x-slot>
                        <x-slot name="laps">{{ $result->laps }}</x-slot>
                        <x-slot name="best_lap">{{ $result->best_lap }}</x-slot>
                        <x-slot name="status">{{ $result->flag_name }}</x-slot>
                    </x-table.qualify-result-row>
                @endforeach
            </x-table.qualify-result-header>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
