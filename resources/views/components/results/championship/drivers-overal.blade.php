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
