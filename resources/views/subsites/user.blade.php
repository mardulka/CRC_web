<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $user->first_name }} {{ $user->last_name }}
        </x-element.site-headline>

        <x-badge.badge-row>
            @foreach($user->roles()->get() as $role)
                <x-badge.role color="{{$role->color}}">
                    {{$role->name}}
                </x-badge.role>
            @endforeach
        </x-badge.badge-row>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.result-table>
                <x-table.result-headrow>
                    <x-table.result-headcell>Jméno</x-table.result-headcell>
                    <x-table.result-headcell>Příjmení</x-table.result-headcell>
                    <x-table.result-headcell>Přezdívka</x-table.result-headcell>
                    <x-table.result-headcell>Národnost</x-table.result-headcell>
                    <x-table.result-headcell>Licence</x-table.result-headcell>
                    <x-table.result-headcell>Aktivní</x-table.result-headcell>
                </x-table.result-headrow>
                <x-table.result-row>
                    <x-table.result-cell>{{ $user->first_name }}</x-table.result-cell>
                    <x-table.result-cell>{{ $user->last_name}}</x-table.result-cell>
                    <x-table.result-cell>{{ $user->nick_name }}</x-table.result-cell>
                    <x-table.result-cell>{{ $country->name }}</x-table.result-cell>
                    <x-table.result-cell>{{$active_license->abbr}}</x-table.result-cell>
                    <x-table.result-cell>{{ $user->active ? 'Ano' : 'Ne'}}</x-table.result-cell>
                </x-table.result-row>
            </x-table.result-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Týmy</x-slot>
            @foreach($teams as $team)
                <x-card.card>
                    <x-slot name="name">{{ $team->name }}</x-slot>
                    <x-slot name="info">Od: {{ $team->from }}</x-slot>
                    <x-slot name="link">{{ $url = route('team', ['id' => $team->team_id ])  }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Závody</x-slot>

            <x-table.result-table>
                <x-table.result-headrow>
                    <x-table.result-headcell>Pozice</x-table.result-headcell>
                    <x-table.result-headcell>Body</x-table.result-headcell>
                    <x-table.result-headcell>Třída</x-table.result-headcell>
                    <x-table.result-headcell>Pozice v třídě</x-table.result-headcell>
                    <x-table.result-headcell>Body v třídě</x-table.result-headcell>
                    <x-table.result-headcell>Tým</x-table.result-headcell>
                    <x-table.result-headcell>Šampionát</x-table.result-headcell>
                    <x-table.result-headcell>Závod</x-table.result-headcell>
                    <x-table.result-headcell>Kategorie vozu</x-table.result-headcell>
                    <x-table.result-headcell>Status</x-table.result-headcell>
                    <x-table.result-headcell>Penalizace</x-table.result-headcell>
                </x-table.result-headrow>
                {{--@foreach($race_results as $result)
                    <x-table.result-row>
                        <x-table.result-cell>{{ $result->res_position }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->points }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->race()->first()->set()->first()->championship->first()->ranks()->where('rank_order', '=', $result->class_order)->first()->abbr}}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->res_class_position }}</x-table.result-cell>
                        <x-table.result-cell>{{ $result->class_points }}</x-table.result-cell>
                        <x-table.result-cell>
                            <x-link.basic link="{{route('team', ['id' => $result->participation()->first()->team_id])}}">
                                {{ $result->participation()->first()->team_name }}
                            </x-link.basic>
                        </x-table.result-cell>
                        <x-table.result-cell>
                            <x-link.basic link="{{route('championship', ['id' => $result->race()->first()->set()->first()->championship()->first()->championship_id])}}">
                                {{ $result->race()->first()->set()->first()->championship()->first()->description }}
                            </x-link.basic>
                        </x-table.result-cell>
                        <x-table.result-cell>
                            <x-link.basic link="{{route('race', ['id' => $result->race()->first()->race_id])}}">
                                {{ $result->race()->first()->name }}
                            </x-link.basic>
                        </x-table.result-cell>
                        <x-table.result-cell>{{ $result->participation()->first()->applications()->where('set_id', '=', $result->race()->first()->set_id)->first()->livery()->first()->car()->first()->car_category()->first()->abbr }}</x-table.result-cell>
                        <x-table.result-cell>@if($result->penalty_flag()->first()){{ $result->penalty_flag()->first()->name }}@endif </x-table.result-cell>
                        <x-table.result-cell>{{ $result->penalization()->get()->sum('position_penalty') > 0 ? "+".$result->penalization()->get()->sum('position_penalty'): "" }}</x-table.result-cell>
                    </x-table.result-row>
                @endforeach--}}
            </x-table.result-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Šampionáty - účast</x-slot>
            @foreach($user->participations()->get() as $partip)
                <x-card.card>
                    <x-slot name="name">{{ $partip->championship()->first()->description }}</x-slot>
                    <x-slot name="info">{{ $partip->championship()->first()->open ? 'Otevřen' : 'Uzavřen' }}</x-slot>
                    <x-slot name="link">{{ $url = route('championship', ['id' => $partip->championship()->first()->championship_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Šampionáty - pořadatelství</x-slot>
            @foreach($user->organized()->get() as $champ)
                <x-card.card>
                    <x-slot name="name">{{ $champ->description }}</x-slot>
                    <x-slot name="info">{{ $champ->open ? 'Otevřen' : 'Uzavřen' }}</x-slot>
                    <x-slot name="link">{{ $url = route('championship', ['id' => $partip->championship()->first()->championship_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Livery</x-slot>
            @foreach($user->liveries()->get() as $livery)
                <x-card.card>
                    <x-slot name="name">{{ $livery->name }}</x-slot>
                    <x-slot name="info">{{ $livery->simulator()->first()->name}}</x-slot>
                    <x-slot name="link">#</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
