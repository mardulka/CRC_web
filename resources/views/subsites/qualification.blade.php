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
            <x-table.result-table>
                <x-table.result-headrow>
                    <x-table.result-headcell>Pozice</x-table.result-headcell>
                    <x-table.result-headcell>Jezdec</x-table.result-headcell>
                    <x-table.result-headcell>Tým</x-table.result-headcell>
                    <x-table.result-headcell>Počet kol</x-table.result-headcell>
                    <x-table.result-headcell>Nejlepší kolo</x-table.result-headcell>
                    <x-table.result-headcell>Status</x-table.result-headcell>
                </x-table.result-headrow>
                @foreach($q_results as $result)
                    <x-table.result-row>
                        <x-table.result-cell>{{ $loop->iteration }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->first_name}} {{ $result->last_name }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->team }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->laps }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->best_lap }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->flag_name }}</x-table.result-cell>
                    </x-table.result-row>
                @endforeach
            </x-table.result-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
