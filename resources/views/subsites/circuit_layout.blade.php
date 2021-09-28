<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $circuit_layout->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno okruhu</x-table.attr-headcell>
                    <x-table.attr-headcell>Jméno layoutu</x-table.attr-headcell>
                    <x-table.attr-headcell>Země</x-table.attr-headcell>
                    <x-table.attr-headcell>Délka</x-table.attr-headcell>
                    <x-table.attr-headcell>Počet zatáček</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('circuit', ['id' => $circuit_layout->circuit_id])}}">
                            {{$circuit_layout->circuit()->first()->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
                    <x-table.attr-cell>{{$circuit_layout->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$circuit_layout->circuit()->first()->country()->first()->name}}</x-table.attr-cell>
                    <x-table.attr-cell></x-table.attr-cell>
                    <x-table.attr-cell></x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Dostupný v simulátorech</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>
                        @foreach($circuit_layout->simulators()->get() as $simulator)
                            <x-link.basic link="{{route('simulator', ['id' => $simulator->simulator_id])}}">
                                {{$simulator->name}}
                            </x-link.basic>
                            @if(!$loop->last) / @endif
                        @endforeach
                    </x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Rekordy CRC</x-slot>

        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Rekordy svět</x-slot>

        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
