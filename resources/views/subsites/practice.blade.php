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
            {{ $practice->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy a nastavení</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno tréninku</x-table.attr-headcell>
                    <x-table.attr-headcell>Závod</x-table.attr-headcell>
                    <x-table.attr-headcell>Set</x-table.attr-headcell>
                    <x-table.attr-headcell>Šampionát</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$practice->name}}</x-table.attr-cell>
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
                    <x-table.attr-cell>{{date('d.m.Y' ,strtotime($practice->date))}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$practice->time}}</x-table.attr-cell>
                    <x-table.attr-cell>{{date('H:i:s | d.m.Y' ,strtotime($practice->ingame_start))}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        @if($practice->dur_time)
                            {{date('G' ,strtotime($practice->dur_time))}}h
                            {{date('i' ,strtotime($practice->dur_time))}}min
                            {{date('s' ,strtotime($practice->dur_time))}}s
                        @else
                            {{$practice->dur_laps}} kol
                        @endif
                    </x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Výsledky</x-slot>
                <div class="text-2xl p-4 bg-green-300">
                    Tady budou výsledky.
                </div>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
