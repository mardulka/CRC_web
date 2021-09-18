<x-app-layout>
    <x-element.content-box>

        <x-element.site-headline>
            {{ $championship->description }}
        </x-element.site-headline>

        <div class="text-2xl">
            Tady bude tabulka atributů.
        </div>


        @foreach($sets as $set)
            <x-card.crate>
                <x-slot name="name">Set {{ $set->set_no }}</x-slot>

                @foreach($races as $race)
                    @if($race->set_id == $set->set_id)
                        <x-card.card>
                            <x-slot name="name">{{ $race->name }}</x-slot>
                            <x-slot name="info">{{ $race->date}}</x-slot>
                            <x-slot name="link">{{ $url = route('race', ['id' => $race->race_id]) }}</x-slot>
                        </x-card.card>
                    @endif
                @endforeach

            </x-card.crate>
        @endforeach


    </x-element.content-box>
</x-app-layout>
