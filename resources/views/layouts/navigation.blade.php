<nav x-data="{ open: false }" class="bg-black sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class=" mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ 'Přehled' }}
                    </x-nav.nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.nav-link :href="route('news')" :active="request()->routeIs('news')">
                        {{ 'Novinky' }}
                    </x-nav.nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.nav-link :href="route('championships')" :active="request()->routeIs('championships')">
                        {{ 'Šampionáty' }}
                    </x-nav.nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.nav-link :href="route('stats')" :active="request()->routeIs('stats')">
                        {{ 'Statistiky' }}
                    </x-nav.nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.nav-link :href="route('rules')" :active="request()->routeIs('rules')">
                        {{ 'Pravidla' }}
                    </x-nav.nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">
                        {{ 'Kontakty' }}
                    </x-nav.nav-link>
                </div>
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-nav.dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-md font-medium text-white hover:text-yellow-300 hover:border-yellow-300 focus:outline-none focus:text-yellow-500 focus:border-gray-500 transition duration-150 ease-in-out">
                            @guest()
                                <div>{{ 'Uživatel nepřihlášen'}}</div>
                            @endguest
                            @auth()
                                <div>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            @endauth
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @guest()
                            <form method="GET" action="{{ route('login') }}">
                                @csrf
                                <x-nav.responsive-nav-link :href="route('login')"
                                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ 'Přihlášení' }}
                                </x-nav.responsive-nav-link>
                            </form>
                            <form method="GET" action="{{ route('register') }}">
                                @csrf
                                <x-nav.responsive-nav-link :href="route('register')"
                                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ 'Registrace' }}
                                </x-nav.responsive-nav-link>
                            </form>
                        @endguest
                        @auth()
                            <x-nav.responsive-nav-link :href="route('user', ['id' => Auth::user()->user_id])">
                                {{ 'Profil' }}
                            </x-nav.responsive-nav-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-nav.responsive-nav-link :href="route('logout')"
                                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ 'Odhlášení' }}
                                </x-nav.responsive-nav-link>
                            </form>
                        @endauth
                    </x-slot>
                </x-nav.dropdown>
            </div>


            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-nav.responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ 'Přehled' }}
            </x-nav.responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-nav.responsive-nav-link>
                {{ 'Novinky' }}
            </x-nav.responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-nav.responsive-nav-link>
                {{ 'Šampionáty' }}
            </x-nav.responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-nav.responsive-nav-link>
                {{ 'Statistiky' }}
            </x-nav.responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-nav.responsive-nav-link>
                {{ 'Pravidla' }}
            </x-nav.responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-nav.responsive-nav-link>
                {{ 'Kontakty' }}
            </x-nav.responsive-nav-link>
        </div>


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth()
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @guest()
                    <form method="GET" action="{{ route('login') }}">
                        @csrf
                        <x-nav.responsive-nav-link :href="route('login')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ 'Přihlášení' }}
                        </x-nav.responsive-nav-link>
                    </form>
                    <form method="GET" action="{{ route('register') }}">
                        @csrf
                        <x-nav.responsive-nav-link :href="route('register')"
                                                   onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ 'Registrace' }}
                        </x-nav.responsive-nav-link>
                    </form>
                @endguest
                @auth()
                    <x-nav.responsive-nav-link :href="route('user', ['id' => Auth::user()->user_id])">
                        {{ 'Profil' }}
                    </x-nav.responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav.responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ 'Odhlášení' }}
                        </x-nav.responsive-nav-link>
                    </form>
                @endauth
            </div>
        </div>


    </div>
</nav>
