<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            {{ $team->name }} ({{ $team->abbr }})
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Atributy</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Název</x-table.attr-headcell>
                    <x-table.attr-headcell>Zkratka</x-table.attr-headcell>
                    <x-table.attr-headcell>Aktivní</x-table.attr-headcell>
                </x-table.attr-headrow>
                <x-table.attr-row>
                    <x-table.attr-cell>{{ $team->name }}</x-table.attr-cell>
                    <x-table.attr-cell>{{ $team->abbr}}</x-table.attr-cell>
                    <x-table.attr-cell>{{ $team->active ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                </x-table.attr-row>
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Aktivní členové</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Od</x-table.attr-headcell>
                    <x-table.attr-headcell>Do</x-table.attr-headcell>
                    <x-table.attr-headcell>Aktivní</x-table.attr-headcell>
                    <x-table.attr-headcell>Vlastník</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($memberships as $membership)
                    @if($membership->active)
                        <x-table.attr-row>
                            <x-table.attr-cell>
                                <x-link.basic link="{{route('user', ['id' => $membership->user()->first()->user_id ])}}">
                                    {{ $membership->user()->first()->first_name }} {{ $membership->user()->first()->last_name }}
                                </x-link.basic>
                            </x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->from }}</x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->until }}</x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->active ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->owner ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                        </x-table.attr-row>
                    @endif
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Bývalí členové</x-slot>
            <x-table.attr-table>
                <x-table.attr-headrow>
                    <x-table.attr-headcell>Jméno</x-table.attr-headcell>
                    <x-table.attr-headcell>Od</x-table.attr-headcell>
                    <x-table.attr-headcell>Do</x-table.attr-headcell>
                    <x-table.attr-headcell>Aktivní</x-table.attr-headcell>
                    <x-table.attr-headcell>Vlastník</x-table.attr-headcell>
                </x-table.attr-headrow>
                @foreach($memberships as $membership)
                    @if(!$membership->active)
                        <x-table.attr-row>
                            <x-table.attr-cell>
                                <x-link.basic link="{{route('user', ['id' => $membership->user()->first()->user_id ])}}">
                                    {{ $membership->user()->first()->first_name }} {{ $membership->user()->first()->last_name }}
                                </x-link.basic>
                            </x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->from }}</x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->until }}</x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->active ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                            <x-table.attr-cell>{{ $membership->owner ? 'Ano' : 'Ne'}}</x-table.attr-cell>
                        </x-table.attr-row>
                    @endif
                @endforeach
            </x-table.attr-table>
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Šampionáty - účast</x-slot>
            @foreach($team->participations()->get()->unique('championship_id') as $partip)
                <x-card.card>
                    <x-slot name="name">{{ $partip->championship()->first()->description }}</x-slot>
                    <x-slot name="info">{{ $partip->championship()->first()->open ? 'Otevřen' : 'Uzavřen' }}</x-slot>
                    <x-slot name="link">{{ $url = route('championship', ['id' => $partip->championship()->first()->championship_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>



    </x-element.content-box>
</x-app-layout>
