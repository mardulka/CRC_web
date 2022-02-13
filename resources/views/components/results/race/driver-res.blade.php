<div class="mx-auto w-full border-gray-200 border rounded-lg my-1 hover:bg-gray-200 hover:ring-1 hover:ring-gray-700">
    <div class="flex">
        <div class="flex text-center rounded-l-lg items-center bg-{{$color}}">
            <div class="flex-none w-10 px-1 sm:w-20 md:px-3">
                <p class="text-sm font-medium md:text-xl">{{$result->penalty_name ?? $result->res_position}}</p>
            </div>
        </div>
        <div class="flex flex-1 items-center">
            <div class="hidden md:flex">
                <img class="w-20 h-20" src="/public/storage/img/placeholders/avatar.png" alt="Driver photo">
            </div>
            <div class="flex-1 px-1 md:px-3">
                <p class="text-sm font-medium text-gray-900 md:text-lg">
                    <x-link.basic link="{{route('user', ['id' => $result->user_id])}}">
                        {{ $result->driver_first_name}} {{ $result->driver_last_name }}
                    </x-link.basic>
                </p>
                <p class="text-xs text-gray-500 md:text-sm">
                    <x-link.basic link="{{route('team', ['id' => $result->team_id])}}">
                        {{ $result->team_name }}
                    </x-link.basic>
                </p>
            </div>
        </div>
        <div class="items-center text-center hidden lg:flex">
            <div class="flex-none px-3">
                <div class="text-base font-medium text-gray-900 truncate">{{$result->best_lap}}</div>
                <div class="text-sm text-gray-400 truncate">Nejlepší kolo</div>
            </div>
            <div class="flex-none px-3">
                <div class="text-base font-medium text-gray-900">{{$result->consistency * 100}}</div>
                <div class="text-sm text-gray-400 truncate">Konzistence</div>
            </div>
            <div class="flex-none px-3">
                <p class="text-base font-medium text-gray-900">{{$result->pitstops_no}}</p>
                <p class="text-sm text-gray-400 truncate">Zastávek</p>
            </div>

        </div>
        <div class="flex items-center text-center @if($result->penalty) bg-red-500 @endif">
            <div class="flex-none w-8 px-1 md:px-3 md:w-16">
                @if($result->penalty)
                    <div class="bg-red-500">
                        <p class="text-xs font-semibold md:text-base">{{'+'.$result->penalty.'p'}}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-center text-center">
            <div class="flex-none w-10 px-1 md:px-3 md:w-20">
                <span class="text-base font-semibold md:text-xl">{{$result->points}}</span>
                <span class="text-xs text-gray-500 md:text-sm">b</span>
            </div>
        </div>
    </div>
</div>
