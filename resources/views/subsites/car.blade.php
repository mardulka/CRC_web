<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $car->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Rok</x-table.attr-headcell>
                    <x-table.attr-headcell>Typ</x-table.attr-headcell>
                    <x-table.attr-headcell>Výrobce</x-table.attr-headcell>
                    <x-table.attr-headcell>Kategorie</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$car->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$car->year}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('car_type', ['id' => $car->car_type()->first()->car_type_id])}}">
                            {{$car->car_type()->first()->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('manufacturer', ['id' => $car->car_type()->first()->manufacturer()->first()->manufacturer_id])}}">
                            {{$car->car_type()->first()->manufacturer()->first()->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('car_category', ['id' => $car->car_category()->first()->car_category_id])}}">
                            {{$car->car_category()->first()->abbr}}
                        </x-link.basic>
                    </x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Liveries</x-slot>

        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
