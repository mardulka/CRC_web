<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $car_category->abbr }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Zkratka</x-table.attr-headcell>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>

                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$car_category->abbr}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$car_category->name}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Vozidla</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Rok</x-table.attr-headcell>
                    <x-table.attr-headcell>Typ</x-table.attr-headcell>
                    <x-table.attr-headcell>Výrobce</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($car_category->cars()->get() as $car)
                    <x-table.attr-row>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('car', ['id' => $car->car_id])}}">
                                {{$car->name}}
                            </x-link.basic>
                        </x-table.attr-cell>
                        <x-table.attr-cell>{{$car->year}}</x-table.attr-cell>
                        <x-table.attr-cell>{{$car->car_type()->first()->name}}</x-table.attr-cell>
                        <x-table.attr-cell>{{$car->car_type()->first()->manufacturer()->first()->year}}</x-table.attr-cell>
                    </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>

