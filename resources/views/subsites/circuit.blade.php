<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $circuit->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Země</x-table.attr-headcell>
                    <x-table.attr-headcell>Fiktivní</x-table.attr-headcell>
                    <x-table.attr-headcell>Počet variant v CRC</x-table.attr-headcell>
                    <x-table.attr-headcell>Odkaz na info</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$circuit->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$circuit->country()->first()->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$circuit->fictional ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$circuit->circuit_layouts()->get()->unique('name')->count()}}</x-table.attr-cell>
                    <x-table.attr-cell></x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Layouty okruhu</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Rok</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($circuit->circuit_layouts()->orderBy('name')->orderByDesc('year')->get() as $layout)
                <x-table.attr-row>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('circuit_layout', ['id' => $layout->circuit_layout_id])}}">
                            {{$layout->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
                    <x-table.attr-cell>{{$layout->year}}</x-table.attr-cell>
                </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
