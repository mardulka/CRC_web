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
                    <x-table.attr-cell>{{$championship->season()->first()->name}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$championship->series()->first()->name}}</x-table.attr-cell>
                    <x-table.attr-cell>
                        <x-link.basic link="{{route('simulator', ['id' => $championship->simulator()->first()->simulator_id])}}">
                            {{$championship->simulator()->first()->name}}
                        </x-link.basic>
                    </x-table.attr-cell>
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
                            <x-link.basic link="{{route('user', ['id' => $organizer->user_id])}}">
                                {{$organizer->first_name}} {{$organizer->last_name}} <br/>
                            </x-link.basic>
                        @endforeach
                    </x-table.attr-cell>
                    <x-table.attr-cell>{{$championship->sets()->get()->count()}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$championship->races()->get()->count()}}</x-table.attr-cell>
                    <x-table.attr-cell>{{$participation->count()}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>


        @foreach($championship->sets()->get() as $set)
            <x-card.crate>
                <x-slot name="name">Set závodů {{ $set->set_no }}</x-slot>

                @foreach($set->races()->get() as $race)
                    <x-card.card>
                        <x-slot name="name">{{ $race->name }}</x-slot>
                        <x-slot name="info">{{date('d.m.Y' ,strtotime($race->date))}}</x-slot>
                        <x-slot name="link">{{ $url = route('race', ['id' => $race->race_id]) }}</x-slot>
                    </x-card.card>
                @endforeach

            </x-card.crate>
        @endforeach

{{--
        <x-card.crate>
            <x-slot name="name">Výsledky OVERALL</x-slot>
            <x-results.championship.drivers-overal :results="$overal_results">
            </x-results.championship.drivers-overal>
        </x-card.crate>


        @foreach($race_categories as $race_category)
            @if($race_category->overall == 1)
                @continue
            @endif
            <x-card.crate>
                <x-slot name="name">Výsledky {{$race_category->name}}</x-slot>
                <x-results.championship.drivers-class :participation="array($participation, $race_category)">
                </x-results.championship.drivers-class>
            </x-card.crate>
        @endforeach
--}}


    </x-element.content-box>
</x-app-layout>
