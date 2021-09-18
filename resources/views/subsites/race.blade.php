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
            <x-table.race-result-header>
                @foreach($r_results as $result)
                    <x-table.race-result-row>
                        <x-slot name="position">{{ $result->position }}</x-slot>
                        <x-slot name="name">{{ $result->first_name}} {{ $result->last_name }}</x-slot>
                        <x-slot name="team">{{ $result->team }}</x-slot>
                        <x-slot name="laps">{{ $result->laps }}</x-slot>
                        <x-slot name="best_lap">{{ $result->best_lap }}</x-slot>
                        <x-slot name="consistency">{{ ($result->consistency)*100 }}</x-slot>
                        <x-slot name="pitstops_no">{{ $result->pits }}</x-slot>
                        <x-slot name="points">{{ $result->points }}</x-slot>
                        <x-slot name="status">{{ $result->flag_name }}</x-slot>
                    </x-table.race-result-row>
                @endforeach
            </x-table.race-result-header>
        </x-card.crate>
    </x-element.content-box>
</x-app-layout>
