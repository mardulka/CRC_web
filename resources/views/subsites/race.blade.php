<x-app-layout>
    <x-element.content-box>

        <x-element.site-headline>
            {{ $race->name }}
        </x-element.site-headline>

        <div class="text-2xl">
            Tady bude tabulka atributů.
        </div>


        <x-card.crate>
            <x-slot name="name">Tréninky</x-slot>
            @foreach($practices as $practice)
                    <x-card.card>
                        <x-slot name="name">{{ $practice->name }}</x-slot>
                        <x-slot name="info">{{ $practice->date}}</x-slot>
                        <x-slot name="link">{{ $url = route('practice', ['id' => $practice->practice_id]) }}</x-slot>
                    </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Kvalifikace</x-slot>
            @foreach($qualifications as $qualification)
                <x-card.card>
                    <x-slot name="name">{{ $qualification->name }}</x-slot>
                    <x-slot name="info">{{ $qualification->date}}</x-slot>
                    <x-slot name="link">{{ $url = route('qualification', ['id' => $qualification->qualification_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

    </x-element.content-box>
</x-app-layout>
