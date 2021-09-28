<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $country->name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Zkratka</x-table.attr-headcell>
                    <x-table.attr-headcell>Kontinent</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$country->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$country->abbr}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$country->continent()->first()->name}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Okruhy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Počet layoutů v CRC</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($country->circuits()->get() as $circuit)
                    <x-table.attr-row>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('circuit', ['id' => $circuit->circuit_id])}}">
                                {{$circuit->name}}
                            </x-link.basic>
                        </x-table.attr-cell>
                        <x-table.attr-cell>{{$circuit->circuit_layouts()->get()->count()}}</x-table.attr-cell>
                    </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Výrobci</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Zkratka</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($country->manufacturers()->get() as $manufacturer)
                    <x-table.attr-row>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('manufacturer', ['id' => $manufacturer->manufacturer_id])}}">
                                {{$manufacturer->name}}
                            </x-link.basic>
                        </x-table.attr-cell>
                        <x-table.attr-cell>{{$manufacturer->abbr}}</x-table.attr-cell>
                    </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Uživatelé</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Přezdívka</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($country->users()->get() as $user)
                    <x-table.attr-row>
                        <x-table.attr-cell>
                            <x-link.basic link="{{route('user', ['id' => $user->user_id])}}">
                                {{$user->first_name}} {{$user->last_name}}
                            </x-link.basic>
                        </x-table.attr-cell>
                        <x-table.attr-cell>{{$user->nick_name}}</x-table.attr-cell>
                    </x-table.attr-row>
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
