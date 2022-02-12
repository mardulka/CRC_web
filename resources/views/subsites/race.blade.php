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
                    <x-table.attr-cell>{{$set->set_no}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('championship', ['id' => $championship->championship_id])}}">
                            {{$championship->description}}
                        </x-link.basic>
                    </x-table.attr-cell>
                    <x-table.attr-cell>
                        @foreach($classes as $class)
                            {{$class->name}} </br>
                        @endforeach
                    </x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('simulator', ['id' => $simulator->simulator_id])}}">
                            {{$simulator->name}}
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
                        <x-link.basic link="{{route('circuit', ['id' => $circuit->circuit_id])}}">
                            {{$circuit->name}}
                        </x-link.basic>
                        >>
                        <x-link.basic link="{{route('circuit_layout', ['id' => $circuit_layout->circuit_layout_id])}}">
                            {{$circuit_layout->name}} {{$circuit_layout->year}}
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



        <div class = "container mx-auto min-h-screen p-2 md:p-8">
            @foreach($race_res as $result)
                <x-results.race.driver-res :result="$result"/>
            @endforeach
        </div>


{{--
        <x-card.crate>
            <x-slot name="name">Výsledky OVERALL</x-slot>
            <x-results.race.drivers-overal :results="$race_res">
            </x-results.race.drivers-overal>
        </x-card.crate>

        @foreach($classes as $class)
            @if($class->overall == 1)
                @continue
            @endif
            <x-card.crate>
                <x-slot name="name">Výsledky pro {{$class->name}}</x-slot>
                <x-results.race.drivers-class :results="$race_res->where('class_id', $class->class_id)->sortBy('res_class_position')">
                </x-results.race.drivers-class>
            </x-card.crate>
        @endforeach
        --}}

    </x-element.content-box>
</x-app-layout>
