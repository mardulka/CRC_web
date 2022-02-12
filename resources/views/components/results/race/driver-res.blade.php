@props(['result'])

<div class="mx-auto w-full border-gray-300 border rounded-lg my-1 bg-gray">
    <div class="flex">
        <div class="flex flex-1 items-center">
            <div class="flex-none w-10 px-1 text-center sm:w-20 md:px-3">
                <p class="text-sm font-medium md:text-xl">{{$result->penalty_name ?? $result->res_position}}</p>
            </div>
            <div class="hidden md:flex">
                <img class="w-20 h-20" src="/public/storage/img/placeholders/avatar.png" alt="Driver photo">
            </div>
            <div class="flex-1 px-1 md:px-3">
                <p class="text-sm font-medium text-gray-900 md:text-lg">{{$result->driver_first_name}} {{$result->driver_last_name}}</p>
                <p class="text-xs gray-500 md:text-sm">{{$result->team_name}}</p>
            </div>
        </div>
        <div class="items-center hidden lg:flex">
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
            <div class="flex-none w-8 px-1 md:px-3 md:w-16">
                <p class="text-sm font-semibold md:text-base">{{$result->penalty ? '+'.$result->penalty.'p':null}}</p>
            </div>
            <div class="flex-none w-10 px-1 md:px-3 md:w-20">
                <span class="text-base font-semibold md:text-xl">{{$result->points}}</span>
                <span class="text-xs text-gray-500 md:text-sm">b</span>
            </div>
        </div>
    </div>
</div>
