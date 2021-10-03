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
                    <x-table.result-headcell>Penalizace</x-table.result-headcell>
                    <x-table.result-headcell>Původní pozice</x-table.result-headcell>
                </x-table.result-headrow>
                @foreach($race->raceResults()->orderBy('res_position')->get() as $result)
                    <x-table.result-row>
                        <x-table.result-cell>{{ $result->res_position }}</x-table.result-cell>
                        <x-table.result-cell>
                            <x-link.basic link="{{route('user', ['id' => $result->participation()->first()->user_id])}}">
                                {{ $result->participation()->first()->driver_first_name}} {{ $result->participation()->first()->driver_last_name }}
                            </x-link.basic>
                        </x-table.result-cell>
                        <x-table.result-cell>
                            <x-link.basic link="{{route('team', ['id' => $result->participation()->first()->team_id])}}">
                                {{ $result->participation()->first()->team_name }}
                            </x-link.basic>
                        </x-table.result-cell>
                        <x-table.result-cell>{{ $result->laps_completed }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->best_lap }}</x-table.result-cell>
                        <x-table.result-cell>{{ ($result->consistency)*100 }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->pitstops_no }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->points }}</x-table.result-cell>
                        <x-table.result-cell>@if($result->penalty_flag()->first()){{ $result->penalty_flag()->first()->name }}@endif </x-table.result-cell>
                        <x-table.result-cell>{{ $result->penalization()->get()->sum('position_penalty') > 0 ? "+".$result->penalization()->get()->sum('position_penalty'): "" }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->init_position }}</x-table.result-cell>
                    </x-table.result-row>
                @endforeach
            </x-table.result-table>
        </x-card.crate>

        @foreach($championship->ranks()->where('rank_order', '>', 0)->orderBy('rank_order')->get() as $res_rank)
            <x-card.crate>
                <x-slot name="name">Výsledky {{$res_rank->abbr}}</x-slot>
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
                    @foreach($race->raceResults()->where('class_order', '=', $res_rank->pivot->rank_order)->orderBy('res_class_position')->get() as $result)
                        <x-table.result-row>
                            <x-table.result-cell>{{ $result->res_class_position }}</x-table.result-cell>
                            <x-table.result-cell>
                                <x-link.basic link="{{route('user', ['id' => $result->participation()->first()->user_id])}}">
                                    {{ $result->participation()->first()->driver_first_name}} {{ $result->participation()->first()->driver_last_name }}
                                </x-link.basic>
                            </x-table.result-cell>
                            <x-table.result-cell>
                                <x-link.basic link="{{route('team', ['id' => $result->participation()->first()->team_id])}}">
                                    {{ $result->participation()->first()->team_name }}
                                </x-link.basic>
                            </x-table.result-cell>
                            <x-table.result-cell>{{ $result->laps_completed }}</x-table.result-cell>
                            <x-table.result-cell>{{ $result->best_lap }}</x-table.result-cell>
                            <x-table.result-cell>{{ ($result->consistency)*100 }}</x-table.result-cell>
                            <x-table.result-cell>{{ $result->pitstops_no }}</x-table.result-cell>
                            <x-table.result-cell>{{ $result->class_points }}</x-table.result-cell>
                            <x-table.result-cell>@if($result->penalty_flag()->first()){{ $result->penalty_flag()->first()->name }}@endif </x-table.result-cell>
                        </x-table.result-row>
                    @endforeach
                </x-table.result-table>
            </x-card.crate>
        @endforeach

    </x-element.content-box>
</x-app-layout>
