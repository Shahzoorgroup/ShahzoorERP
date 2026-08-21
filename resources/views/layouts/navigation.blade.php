<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <div class="flex">

                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <span class="text-xl font-bold text-blue-600">
                            ShahzoorERP
                        </span>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:space-x-6 sm:ms-10">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('branches.index')" :active="request()->routeIs('branches.*')">
                        Branches
                    </x-nav-link>

                    <x-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">
                        Customers
                    </x-nav-link>

                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        Categories
                    </x-nav-link>

                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        Products
                    </x-nav-link>

                    <x-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')">
                        Sales
                    </x-nav-link>

                    <x-nav-link :href="route('recoveries.index')" :active="request()->routeIs('recoveries.*')">
                        Recoveries
                    </x-nav-link>

                    <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
                        Roles
                    </x-nav-link>

                </div>

            </div>

            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:text-blue-600">

                            {{ Auth::user()->name }}

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

        </div>

    </div>

</nav>