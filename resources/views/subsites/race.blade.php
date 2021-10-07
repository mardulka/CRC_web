<x-app-layout>
    <x-element.content-box>

        <x-element.basic-navigation>
            <x-element.back-button link="{{route('championship', ['id' => $championship->championship_id])}}">
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
                    <x-table.attr-cell>{{$race->set()->first()->set_no}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('championship', ['id' => $championship->championship_id])}}">
                            {{$championship->description}}
                        </x-link.basic>
                    </x-table.attr-cell>
                    @foreach($car_categories as $car_category)
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('car_category', ['id' => $car_category->car_category_id])}}">
                                {{$car_category->abbr}}
                            </x-link.basic>
                        </x-table.attr-cell>
                    @endforeach
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('simulator', ['id' => $championship->simulator()->first()->simulator_id])}}">
                            {{$championship->simulator()->first()->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
                </x-table.attr-row>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Datum</x-table.attr-headcell>
                    <x-table.attr-headcell>Čas</x-table.attr-headcell>
                    <x-table.attr-headcell>Herní start</x-table.attr-headcell>
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
                    <x-table.attr-headcell>Okruh a jeho varianta</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('circuit', ['id' => $race->circuitLayout()->first()->circuit()->first()->circuit_id])}}">
                            {{$race->circuitLayout()->first()->circuit()->first()->name}}
                        </x-link.basic>
                        >>
                        <x-link.basic link="{{route('circuit_layout', ['id' => $race->circuitLayout()->first()->circuit_layout_id])}}">
                            {{$race->circuitLayout()->first()->name}} {{$race->circuitLayout()->first()->year}}
                        </x-link.basic>
                    </x-table.attr-cell>
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
            @foreach($race->practices()->get() as $practice)
                <x-card.card>
                    <x-slot name="name">{{ $practice->name }}</x-slot>
                    <x-slot name="info">{{ date('d.m.Y' ,strtotime($practice->date)) }}</x-slot>
                    <x-slot name="link">{{ $url = route('practice', ['id' => $practice->practice_id]) }}</x-slot>
                </x-card.card>
            @endforeach
            @foreach($race->qualifications()->get() as $qualification)
                <x-card.card>
                    <x-slot name="name">{{ $qualification->name }}</x-slot>
                    <x-slot name="info">{{ date('d.m.Y' ,strtotime($qualification->date)) }}</x-slot>
                    <x-slot name="link">{{ $url = route('qualification', ['id' => $qualification->qualification_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Výsledky OVERALL</x-slot>
            <x-results.race.drivers-overal :results="$race->raceResults()->orderBy('res_position')->get()">
            </x-results.race.drivers-overal>
        </x-card.crate>

        @foreach($championship->ranks()->where('rank_order', '>', 0)->orderBy('rank_order')->get() as $res_rank)
            <x-card.crate>
                <x-slot name="name">Výsledky {{$res_rank->abbr}}</x-slot>
                <x-results.race.drivers-overal :results="$race->raceResults()->where('class_order', '=', $res_rank->pivot->rank_order)->orderBy('res_class_position')->get()">
                </x-results.race.drivers-overal>
            </x-card.crate>
        @endforeach

    </x-element.content-box>
</x-app-layout>
