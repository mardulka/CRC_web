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
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno závodu</x-table.attr-headcell>
                    <x-table.attr-headcell>Set</x-table.attr-headcell>
                    <x-table.attr-headcell>Šampionát</x-table.attr-headcell>
                    <x-table.attr-headcell>Kategorie</x-table.attr-headcell>
                    <x-table.attr-headcell>Simulátor</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$race->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$set->set_no}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$championship->description}}</x-table.attr-cell>
                    @foreach($car_categories as $car_category)
                        <x-table.attr-cell>{{$car_category->abbr}}</x-table.attr-cell>
                    @endforeach
                    <x-table.attr-cell>{{$simulator->name}}</x-table.attr-cell>
                </x-table.attr-row>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Datum</x-table.attr-headcell>
                    <x-table.attr-headcell>Čas</x-table.attr-headcell>
                    <x-table.attr-headcell>Herní čas</x-table.attr-headcell>
                    <x-table.attr-headcell>Délka</x-table.attr-headcell>
                    <x-table.attr-headcell>Povinných pitstopů</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{date('d.m.Y' ,strtotime($race->date))}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$race->time}}</x-table.attr-cell>
                    <x-table.attr-cell>{{date('H:i:s | d.m.Y' ,strtotime($race->ingame_start))}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        @if($race->dur_time)
                            {{date('G' ,strtotime($race->dur_time))}}h
                            {{date('i' ,strtotime($race->dur_time))}}min
                            {{date('s' ,strtotime($race->dur_time))}}s
                        @else
                            {{$race->dur_laps}} kol
                        @endif
                    </x-table.attr-cell>
                    <x-table.attr-cell>{{$race->mand_pits}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Předpověď počasí</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$race->weather}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Tréninky a kvalifikace</x-slot>
            @foreach($practices as $practice)
                    <x-card.card>
                        <x-slot name="name">{{ $practice->name }}</x-slot>
                        <x-slot name="info">{{ date('d.m.Y' ,strtotime($practice->date)) }}</x-slot>
                        <x-slot name="link">{{ $url = route('practice', ['id' => $practice->practice_id]) }}</x-slot>
                    </x-card.card>
            @endforeach
            @foreach($qualifications as $qualification)
                <x-card.card>
                    <x-slot name="name">{{ $qualification->name }}</x-slot>
                    <x-slot name="info">{{ date('d.m.Y' ,strtotime($qualification->date)) }}</x-slot>
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