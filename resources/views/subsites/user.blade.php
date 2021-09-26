<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $user->first_name }} {{ $user->last_name }}
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.result-table>
                <x-table.result-headrow>
                    <x-table.result-headcell>Jméno</x-table.result-headcell>
                    <x-table.result-headcell>Příjmení</x-table.result-headcell>
                    <x-table.result-headcell>Přezdívka</x-table.result-headcell>
                    <x-table.result-headcell>Národnost</x-table.result-headcell>
                    <x-table.result-headcell>Email</x-table.result-headcell>
                    <x-table.result-headcell>Steam_ID</x-table.result-headcell>
                    <x-table.result-headcell>Aktivní</x-table.result-headcell>
                </x-table.result-headrow>
                    <x-table.result-row>
                        <x-table.result-cell>{{ $user->first_name }}</x-table.result-cell>
                        <x-table.result-cell>{{ $user->last_name}}</x-table.result-cell>
                        <x-table.result-cell>{{ $user->nick_name }}</x-table.result-cell>
                        <x-table.result-cell>{{ $user->country()->first()->name }}</x-table.result-cell>
                        <x-table.result-cell>{{ $user->email }}</x-table.result-cell>
                        <x-table.result-cell>{{ $user->steam_id }}</x-table.result-cell>
                        <x-table.result-cell>{{ $user->active ? 'true' : 'false'}}</x-table.result-cell>
                    </x-table.result-row>
            </x-table.result-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Týmy</x-slot>

        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Posádky</x-slot>

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
