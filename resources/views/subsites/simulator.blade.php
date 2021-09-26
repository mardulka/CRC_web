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

    </x-element.content-box>
</x-app-layout>
