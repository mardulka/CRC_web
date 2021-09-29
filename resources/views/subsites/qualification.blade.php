<x-app-layout>
    <x-element.content-box>

        <x-element.basic-navigation>
            <x-element.back-button link="{{route('championship', ['id' => $championship->championship_id])}}">
                {{$championship->description}}
            </x-element.back-button>
            >
            <x-element.back-button link="{{route('race', ['id' => $race->race_id])}}">
                {{ $race->name }}
            </x-element.back-button>
        </x-element.basic-navigation>

        <x-element.site-headline>
            {{ $qualification->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy a nastavení</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno kvalifikace</x-table.attr-headcell>
                    <x-table.attr-headcell>Závod</x-table.attr-headcell>
                    <x-table.attr-headcell>Set</x-table.attr-headcell>
                    <x-table.attr-headcell>Šampionát</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$qualification->name}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('race', ['id' => $race->race_id])}}">
                            {{$race->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
                    <x-table.attr-cell>{{$set->set_no}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('championship', ['id' => $championship->championship_id])}}">
                            {{$championship->description}}
                        </x-link.basic>
                    </x-table.attr-cell>
                </x-table.attr-row>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Datum</x-table.attr-headcell>
                    <x-table.attr-headcell>Čas</x-table.attr-headcell>
                    <x-table.attr-headcell>Herní start</x-table.attr-headcell>
                    <x-table.attr-headcell>Délka</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{date('d.m.Y' ,strtotime($qualification->date))}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$qualification->time}}</x-table.attr-cell>
                    <x-table.attr-cell>{{date('H:i:s | d.m.Y' ,strtotime($qualification->ingame_start))}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        @if($qualification->dur_time)
                            {{date('G' ,strtotime($qualification->dur_time))}}h
                            {{date('i' ,strtotime($qualification->dur_time))}}min
                            {{date('s' ,strtotime($qualification->dur_time))}}s
                        @else
                            {{$qualification->dur_laps}} kol
                        @endif
                    </x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
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
                        <x-table.result-cell>@if($penalty_flag=$result->penaltyFlag()->first()){{ $penalty_flag->name}}@endif</x-table.result-cell>
                    </x-table.result-row>
                @endforeach
            </x-table.result-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
