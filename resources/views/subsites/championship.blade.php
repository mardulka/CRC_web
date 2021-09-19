<x-app-layout>
    <x-element.content-box>

        <x-element.basic-navigation>
            <x-element.back-button>
                <x-slot name="link">{{ $url = route('championships') }}</x-slot>
                Zpět na přehled
            </x-element.back-button>
        </x-element.basic-navigation>

        <x-element.site-headline>
            {{ $championship->description }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy a nastavení</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno šampionátu</x-table.attr-headcell>
                    <x-table.attr-headcell>Sezóna</x-table.attr-headcell>
                    <x-table.attr-headcell>Série</x-table.attr-headcell>
                    <x-table.attr-headcell>Simulátor</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{$championship->description}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$season->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$series->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$simulator->name}}</x-table.attr-cell>
                </x-table.attr-row>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Organizátoři</x-table.attr-headcell>
                    <x-table.attr-headcell>Počet setů</x-table.attr-headcell>
                    <x-table.attr-headcell>Počet závodů</x-table.attr-headcell>
                    <x-table.attr-headcell>Přihlášeno jezdců</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>
                        @foreach($organizers as $organizer)
                            {{$organizer->first_name}} {{$organizer->last_name}} <br/>
                        @endforeach
                    </x-table.attr-cell>
                    <x-table.attr-cell>{{$sets->count()}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$races->count()}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$drivers->count()}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>


        @foreach($sets as $set)
            <x-card.crate>
                <x-slot name="name">Set závodů {{ $set->set_no }}</x-slot>

                @foreach($races as $race)
                    @if($race->set_id == $set->set_id)
                        <x-card.card>
                            <x-slot name="name">{{ $race->name }}</x-slot>
                            <x-slot name="info">{{date('d.m.Y' ,strtotime($race->date))}}</x-slot>
                            <x-slot name="link">{{ $url = route('race', ['id' => $race->race_id]) }}</x-slot>
                        </x-card.card>
                    @endif
                @endforeach

            </x-card.crate>
        @endforeach

        <x-card.crate>
            <x-slot name="name">Výsledky</x-slot>
            <x-table.result-table>
                <x-table.result-headrow>
                    <x-table.result-headcell>Pozice</x-table.result-headcell>
                    <x-table.result-headcell>Jezdec</x-table.result-headcell>
                    <x-table.result-headcell>Tým</x-table.result-headcell>
                    <x-table.result-headcell>Body</x-table.result-headcell>
                </x-table.result-headrow>
                @foreach($ch_results as $result)
                    <x-table.result-row>
                        <x-table.result-cell>{{ $loop->iteration }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->first_name}} {{ $result->last_name }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->team }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->r_points }}</x-table.result-cell>
                    </x-table.result-row>
                @endforeach
            </x-table.result-table>
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
