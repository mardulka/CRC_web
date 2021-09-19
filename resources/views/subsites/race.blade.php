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


        <x-card.crate>
            <x-slot name="name">Atributy a nastavení</x-slot>
            <div class="text-2xl p-4 bg-yellow-300">
                Tady bude tabulka atributů.
            </div>
        </x-card.crate>

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

        <x-card.crate>
            <x-slot name="name">Výsledky</x-slot>
            <x-table.result-table>
                <x-table.result-headrow>
                    <x-table.result-headcell>Pozice</x-table.result-headcell>
                    <x-table.result-headcell>Jezdec</x-table.result-headcell>
                    <x-table.result-headcell>Tým</x-table.result-headcell>
                    <x-table.result-headcell>Počet kol</x-table.result-headcell>
                    <x-table.result-headcell>Nejlepší kolo</x-table.result-headcell>
                    <x-table.result-headcell>Konzistence</x-table.result-headcell>
                    <x-table.result-headcell>Zastávek</x-table.result-headcell>
                    <x-table.result-headcell>Body</x-table.result-headcell>
                    <x-table.result-headcell>Status</x-table.result-headcell>
                </x-table.result-headrow>
                @foreach($r_results as $result)
                    <x-table.result-row>
                        <x-table.result-cell>{{ $result->position }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->first_name}} {{ $result->last_name }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->team }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->laps }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->best_lap }}</x-table.result-cell>
                        <x-table.result-cell>{{ ($result->consistency)*100 }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->pits }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->points }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->flag_name }}</x-table.result-cell>
                    </x-table.result-row>
                @endforeach
            </x-table.result-table>
        </x-card.crate>
    </x-element.content-box>
</x-app-layout>
