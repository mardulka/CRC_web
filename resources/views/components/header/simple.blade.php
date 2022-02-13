@props(['url'])

<div class="container bg-white border">
    <div class="flex flex-col-reverse h-32 lg:h-52 bg-origin-border bg-fix bg-cover bg-center"
         style="background-image: url({{$url}})">
        <div class="p-4 inline-block">
            <h1 class="font-bold text-gray-900 text-xl md:text-2xl lg:text-4xl">
                {{$slot}}
            </h1>
        </div>
    </div>
</div>
