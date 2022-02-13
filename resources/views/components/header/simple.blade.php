@props(['url'])

<div class="flex w-full bg-white border">
    <div class="flex-1 flex flex-col-reverse h-20 md:h-32 xl:h-52 bg-origin-border bg-fix bg-cover bg-center"
         style="background-image: url({{$url}})">
        <div class="p-1 md:p-4 inline-block">
            <h1 class="font-bold text-gray-900 text-xl md:text-2xl xl:text-4xl">
                {{$slot}}
            </h1>
        </div>
    </div>
</div>
