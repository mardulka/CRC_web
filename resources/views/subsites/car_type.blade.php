<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $car_type->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Výrobce</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$car_type->name}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('manufacturer', ['id' => $car_type->manufacturer()->first()->manufacturer_id])}}">
                            {{$car_type->manufacturer()->first()->abbr}}
                        </x-link.basic>
                    </x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Vozy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Rok</x-table.attr-headcell>
                    <x-table.attr-headcell>Kategorie</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($car_type->cars()->get() as $car)
                    <x-table.attr-row>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('car', ['id' => $car->car_id])}}">
                                {{$car->name}}
                            </x-link.basic>
                        </x-table.attr-cell>
                        <x-table.attr-cell>{{$car->year}}</x-table.attr-cell>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('car_category', ['id' => $car->car_category()->first()->car_category_id])}}">
                                {{$car->car_category()->first()->abbr}}
                            </x-link.basic>
                        </x-table.attr-cell>
                    </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
