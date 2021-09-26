<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            CRC Group
        </x-element.site-headline>

        <div class="m-20 text-3xl text-center w-auto">
            Vítejte na stránkách závodní komunity CRC.<br/>
            Pojďte si s námi zazávodit v některém z šampionátů!
        </div>


        <x-card.crate>
            <x-slot name="name">Aktuální šampionáty</x-slot>

            @foreach($championships as $championship)
                <x-card.card>
                    <x-slot name="name">{{ $championship->description }}</x-slot>
                    <x-slot name="info">{{ $championship->open ? 'Registrace' : 'Uzavřen' }}</x-slot>
                    <x-slot name="link">{{ $url = route('championship', ['id' => $championship->championship_id]) }}</x-slot>
                </x-card.card>
            @endforeach

        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
