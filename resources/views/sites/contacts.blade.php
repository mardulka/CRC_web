<x-app-layout>
    <x-element.content-box>
        <x-element.site-headline>
            Kontakty
        </x-element.site-headline>

        <x-card.crate>
            <x-slot name="name">Odkazy</x-slot>
            <x-card.card>
                <x-slot name="name">Discord</x-slot>
                <x-slot name="info"></x-slot>
                <x-slot name="link">#</x-slot>
            </x-card.card>
            <x-card.card>
                <x-slot name="name">Facebook</x-slot>
                <x-slot name="info"></x-slot>
                <x-slot name="link">#</x-slot>
            </x-card.card>
            <x-card.card>
                <x-slot name="name">Youtube</x-slot>
                <x-slot name="info"></x-slot>
                <x-slot name="link">#</x-slot>
            </x-card.card>
            <x-card.card>
                <x-slot name="name">Twitch</x-slot>
                <x-slot name="info"></x-slot>
                <x-slot name="link">#</x-slot>
            </x-card.card>

        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Organizátoři</x-slot>
            @foreach($organizers as $organizer)
                <x-card.card>
                    <x-slot name="name">{{ $organizer->first_name }} {{ $organizer->last_name }}</x-slot>
                    <x-slot name="info"></x-slot>
                    <x-slot name="link">{{ $url = route('user', ['id' => $organizer->user_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Komisaři</x-slot>
            @foreach($marshals as $marshal)
                <x-card.card>
                    <x-slot name="name">{{ $marshal->first_name }} {{ $marshal->last_name }}</x-slot>
                    <x-slot name="info"></x-slot>
                    <x-slot name="link">{{ $url = route('user', ['id' => $marshal->user_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>

        <x-card.crate>
            <x-slot name="name">Administrátoři</x-slot>
            @foreach($admins as $admin)
                <x-card.card>
                    <x-slot name="name">{{ $admin->first_name }} {{ $admin->last_name }}</x-slot>
                    <x-slot name="info"></x-slot>
                    <x-slot name="link">{{ $url = route('user', ['id' => $admin->user_id]) }}</x-slot>
                </x-card.card>
            @endforeach
        </x-card.crate>


    </x-element.content-box>
</x-app-layout>
