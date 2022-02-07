<x-table.result-table>
    <x-table.result-headrow>
        <x-table.result-headcell>Pozice</x-table.result-headcell>
        <x-table.result-headcell>Jezdec</x-table.result-headcell>
        <x-table.result-headcell>Tým</x-table.result-headcell>
        <x-table.result-headcell>Počet kol</x-table.result-headcell>
        <x-table.result-headcell>Nejlepší kolo</x-table.result-headcell>
        <x-table.result-headcell>Konzistence</x-table.result-headcell>
        <x-table.result-headcell>Zastávek</x-table.result-headcell>
        <x-table.result-headcell>Body</x-table.result-headcell>
        <x-table.result-headcell>Status</x-table.result-headcell>
        <x-table.result-headcell>Penalizace</x-table.result-headcell>
        <x-table.result-headcell>Původní pozice</x-table.result-headcell>
    </x-table.result-headrow>
    @foreach($results as $result)
        <x-table.result-row>
            <x-table.result-cell>{{ $result->res_position }}</x-table.result-cell>
            <x-table.result-cell>
                <x-link.basic link="{{route('user', ['id' => $result->user_id])}}">
                    {{ $result->driver_first_name}} {{ $result->driver_last_name }}
                </x-link.basic>
            </x-table.result-cell>
            <x-table.result-cell>
                <x-link.basic link="{{route('team', ['id' => $result->team_id])}}">
                    {{ $result->team_name }}
                </x-link.basic>
            </x-table.result-cell>
            <x-table.result-cell>{{ $result->laps_completed }}</x-table.result-cell>
            <x-table.result-cell>{{ $result->best_lap }}</x-table.result-cell>
            <x-table.result-cell>{{ ($result->consistency)*100 }}</x-table.result-cell>
            <x-table.result-cell>{{ $result->pitstops_no }}</x-table.result-cell>
            <x-table.result-cell>{{ $result->points }}</x-table.result-cell>
            <x-table.result-cell>{{ $result->penalty_name ?: null}}</x-table.result-cell>
            <x-table.result-cell>{{ $result->penalty ? '+'.$result->penalty : null}}</x-table.result-cell>
            <x-table.result-cell>{{ $result->init_position }}</x-table.result-cell>
        </x-table.result-row>
    @endforeach
</x-table.result-table>
