<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Role-Based Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (auth()->user()->role === 'student')
                        <x-nav-link :href="route('student-dashboard')" :active="request()->routeIs('student-dashboard')">
                            Student Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('appointments.create')" :active="request()->routeIs('appointments.create')">
                            Request Appointment
                        </x-nav-link>
                        <x-nav-link :href="route('appointments.status')" :active="request()->routeIs('appointments.status')">
                            My Appointments
                        </x-nav-link>
                    @elseif (auth()->user()->role === 'counselor')
                        <x-nav-link :href="route('counselor-dashboard')" :active="request()->routeIs('counselor-dashboard')">
                            Counselor Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                            Appointments
                        </x-nav-link>
                        <x-nav-link :href="route('students.index')" :active="request()->routeIs('students.*')">
                            Student Records
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (auth()->user()->role === 'student')
                <x-responsive-nav-link :href="route('student-dashboard')" :active="request()->routeIs('student-dashboard')">
                    Student Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('appointments.create')" :active="request()->routeIs('appointments.create')">
                    Request Appointment
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('appointments.status')" :active="request()->routeIs('appointments.status')">
                    My Appointments
                </x-responsive-nav-link>
            @elseif (auth()->user()->role === 'counselor')
                <x-responsive-nav-link :href="route('counselor-dashboard')" :active="request()->routeIs('counselor-dashboard')">
                    Counselor Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                    Appointments
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('students.index')" :active="request()->routeIs('students.*')">
                    Student Records
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile User Info -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
