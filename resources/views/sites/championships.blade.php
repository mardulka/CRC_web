<x-app-layout>

    <x-element.content-box>

        <x-element.site-headline>
            Šampionáty
        </x-element.site-headline>

        @foreach($seasons as $season)
            <x-card.crate>
                <x-slot name="name">{{ $season->name }}</x-slot>

                @foreach($championships as $championship)
                    @if($season->season_id == $championship->season_id)
                        <x-card.card>
                            <x-slot name="name">{{ $championship->description }}</x-slot>
                            <x-slot name="info">{{ $championship->open ? 'Registrace' : 'Uzavřen' }}</x-slot>
                            <x-slot name="link">#</x-slot>
                            Šampionát
                        </x-card.card>
                    @endif
                @endforeach

            </x-card.crate>
        @endforeach
    </x-element.content-box>

</x-app-layout>
