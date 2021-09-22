<x-app-layout>
    <x-element.content-box>

        <x-element.site-headline>
            Šampionáty
        </x-element.site-headline>

        @foreach($seasons as $season)
            <x-card.crate>
                <x-slot name="name">{{ $season->name }}</x-slot>

                @foreach($season->championships()->get() as $championship)
                        <x-card.card>
                            <x-slot name="name">{{ $championship->description }}</x-slot>
                            <x-slot name="info">{{ $championship->open ? 'Registrace' : 'Uzavřen' }}</x-slot>
                            <x-slot name="link">{{ $url = route('championship', ['id' => $championship->championship_id]) }}</x-slot>
                        </x-card.card>
                @endforeach

            </x-card.crate>
        @endforeach

    </x-element.content-box>
</x-app-layout>
