<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $manufacturer->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Zkratka</x-table.attr-headcell>
                    <x-table.attr-headcell>Země</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$manufacturer->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$manufacturer->abbr}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('country', ['id' => $manufacturer->country()->first()->country_id])}}">
                            {{$manufacturer->country()->first()->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Typy vozů</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Počet vozů v CRC</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($manufacturer->car_types()->get() as $car_type)
                    <x-table.attr-row>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('car_type', ['id' => $car_type->car_type_id])}}">
                                {{$car_type->name}}
                            </x-link.basic>
                        </x-table.attr-cell>
                        <x-table.attr-cell>{{$car_type->cars()->get()->count()}}</x-table.attr-cell>
                    </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
