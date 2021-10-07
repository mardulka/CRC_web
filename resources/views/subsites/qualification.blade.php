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
            <x-results.qualify.drivers-overal :results="$q_results">
            </x-results.qualify.drivers-overal>
        </x-card.crate>


    </x-element.content-box>
</x-app-layout>
