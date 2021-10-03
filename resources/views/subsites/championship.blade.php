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

        <x-card.crate>
            <x-slot name="name">Výsledky OVERALL</x-slot>
            <x-table.result-table>
                <x-table.result-headrow>
                    <x-table.result-headcell>Pozice</x-table.result-headcell>
                    <x-table.result-headcell>Jezdec</x-table.result-headcell>
                    <x-table.result-headcell>Tým</x-table.result-headcell>
                    <x-table.result-headcell>Body</x-table.result-headcell>
                </x-table.result-headrow>
                @foreach($participation as $partip)
                    <x-table.result-row>
                        <x-table.result-cell>{{ $loop->iteration }}</x-table.result-cell>
                        <x-table.result-cell>
                            <x-link.basic link="{{route('user', ['id' => $partip->user_id])}}">
                                {{ $partip->driver_first_name}} {{ $partip->driver_last_name }}
                            </x-link.basic>
                        </x-table.result-cell>
                        <x-table.result-cell>
                            <x-link.basic link="{{route('team', ['id' => $partip->user_id])}}">
                                {{ $partip->team_name }}
                            </x-link.basic>
                        </x-table.result-cell>
                        <x-table.result-cell>{{ $partip->sum_points}}</x-table.result-cell>
                    </x-table.result-row>
                @endforeach
            </x-table.result-table>
        </x-card.crate>

        @foreach($championship->ranks()->where('rank_order', '>', 0)->orderBy('rank_order')->get() as $res_rank)
            <x-card.crate>
                <x-slot name="name">Výsledky {{$res_rank->abbr}}</x-slot>
                <x-table.result-table>
                    <x-table.result-headrow>
                        <x-table.result-headcell>Pozice</x-table.result-headcell>
                        <x-table.result-headcell>Jezdec</x-table.result-headcell>
                        <x-table.result-headcell>Tým</x-table.result-headcell>
                        <x-table.result-headcell>Body</x-table.result-headcell>
                    </x-table.result-headrow>
                    @foreach($participation->where('class_order', '=', $res_rank->pivot->rank_order)->sortByDesc('sum_class_points') as $partip)
                        <x-table.result-row>
                            <x-table.result-cell>{{ $loop->iteration }}</x-table.result-cell>
                            <x-table.result-cell>
                                <x-link.basic link="{{route('user', ['id' => $partip->user_id])}}">
                                    {{ $partip->driver_first_name}} {{ $partip->driver_last_name }}
                                </x-link.basic>
                            </x-table.result-cell>
                            <x-table.result-cell>
                                <x-link.basic link="{{route('team', ['id' => $partip->user_id])}}">
                                    {{ $partip->team_name }}
                                </x-link.basic>
                            </x-table.result-cell>
                            <x-table.result-cell>{{ $partip->sum_class_points }}</x-table.result-cell>
                        </x-table.result-row>
                    @endforeach
                </x-table.result-table>
            </x-card.crate>
        @endforeach

    </x-element.content-box>
</x-app-layout>
