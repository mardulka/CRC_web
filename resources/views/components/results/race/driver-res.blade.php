@props(['result'])

<div class="mx-auto w-full border-gray-300 border rounded-lg my-1 bg-gray">
    <div class="flex">
        <div class="flex flex-1 items-center">
            <div class="flex-none w-20 px-3 text-center">
                <p class="text-xl">{{$result->penalty_name ?? $result->res_position}}</p>
            </div>
            <div class="hidden md:flex">
                <img class="w-20 h-20" src="/public/storage/img/placeholders/avatar.png" alt="Driver photo">
            </div>
            <div class="flex-1 px-3">
                <p class="text-lg font-medium text-gray-900 truncate">{{$result->driver_first_name}} {{$result->driver_last_name}}</p>
                <p class="text-sm text-gray-500 truncate">{{$result->team_name}}</p>
            </div>
        </div>
        <div class="items-center hidden md:flex">
            <div class="flex-none px-3">
                <div class="text-base font-medium text-gray-900 truncate">{{$result->best_lap}}</div>
                <div class="text-sm text-gray-400 truncate">Nejlepší kolo</div>
            </div>
            <div class="flex-none px-3">
                <div class="text-base font-medium text-gray-900 truncate">{{$result->consistency * 100}}</div>
                <div class="text-sm text-gray-400 truncate">Konzistence</div>
            </div>
            <div class="flex-none px-3">
                <p class="text-base font-medium text-gray-900 truncate">{{$result->pitstops_no}}</p>
                <p class="text-sm text-gray-400 truncate">Zastávek</p>
            </div>

        </div>
        <div class="flex items-center text-center">
            <div class="flex-none w-16 px-3 ">
                <p class="text-base font-semibold">{{$result->penalty ? '+'.$result->penalty.'p':null}}</p>
            </div>
            <div class="flex-none w-20 px-3">
                <span class="text-xl font-semibold">{{$result->points}}</span>
                <span class="text-sm text-gray-500">b</span>
            </div>
        </div>
    </div>
</div>
