<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $simulator->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Zkratka</x-table.attr-headcell>
                    <x-table.attr-headcell>Datum vydání</x-table.attr-headcell>
                    <x-table.attr-headcell>Vydavatel</x-table.attr-headcell>
                    <x-table.attr-headcell>Aktivní</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$simulator->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$simulator->abbr}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$simulator->release_date}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$simulator->producer}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$simulator->active ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Šampionáty</x-slot>
            @foreach($simulator->championships()->get() as $championship)
                <x-card.card>
                    <x-slot name="name">{{ $championship->description }}</x-slot>
                    <x-slot name="info">{{ $championship->open ? 'Otevřen' : 'Uzavřen' }}</x-slot>
                    <x-slot name="link">{{ $url = route('championship', ['id' => $championship->championship_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Okruhy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno okruhu</x-table.attr-headcell>
                    <x-table.attr-headcell>Země</x-table.attr-headcell>
                    <x-table.attr-headcell>Název layoutu</x-table.attr-headcell>
                    <x-table.attr-headcell>Rok layoutu</x-table.attr-headcell>
                    <x-table.attr-headcell>Fiktivní</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($circuits as $circuit)
                    <x-table.attr-row>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('circuit', ['id' => $circuit->circuit_id])}}">
                                {{$circuit->circuit_name}}
                            </x-link.basic>
                        </x-table.attr-cell>
                        <x-table.attr-cell>{{$circuit->country_name}}</x-table.attr-cell>
                        <x-table.attr-cell>{{$circuit->layout_name}}</x-table.attr-cell>
                        <x-table.attr-cell>{{$circuit->layout_year}}</x-table.attr-cell>
                        <x-table.attr-cell>{{$circuit->circuit_fictional ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                    </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Vozy</x-slot>
            @foreach($cars as $car)
                <x-card.card>
                    <x-slot name="name">{{ $car->car_name }}</x-slot>
                    <x-slot name="info">{{ $car->manufacturer_name }}</x-slot>
                    <x-slot name="link"></x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
