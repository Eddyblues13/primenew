<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Prime Trade Access')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            500: '#a071ff', // Purple from auth
                            400: '#b48eff',
                        },
                        dark: {
                            900: '#08060f', // Main bg
                            800: '#130e20', // Card bg
                            700: '#1c192b', // Input/hover bg
                            600: '#2a2536', // Border/divider
                        }
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js for simple interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #2a2536;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #383147;
        }

        .glass-panel {
            background: rgba(19, 14, 32, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = 'fcd805574ebf2082b1afb7ec22afa3d6c97b04e8';
        window.smartsupp || (function (d) {
            var s, c, o = smartsupp = function () { o._.push(arguments) }; o._ = [];
            s = d.getElementsByTagName('script')[0]; c = d.createElement('script');
            c.type = 'text/javascript'; c.charset = 'utf-8'; c.async = true;
            c.src = 'https://www.smartsuppchat.com/loader.js?'; s.parentNode.insertBefore(c, s);
        })(document);
    </script>
    <noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>

</head>

<body class="bg-dark-900 text-gray-100 font-sans antialiased overflow-hidden flex h-screen"
    x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 w-64 glass-panel border-r border-dark-600 transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto lg:block flex flex-col">
        <div class="flex items-center justify-center h-20 border-b border-dark-600 px-6">
            <a href="/" class="flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Prime Trade Access" style="height: 140px;" />
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('deposits.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('deposits.*') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                Deposit Funds
            </a>
            <a href="{{ route('investments.tesla') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('investments.tesla') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Tesla Investment
            </a>
            <a href="{{ route('investments.crypto') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('investments.crypto') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                Crypto Investment
            </a>
            <a href="{{ route('investments.history') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('investments.history') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Investment History
            </a>
            <a href="{{ route('withdrawals.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('withdrawals.*') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0zm-1.07 18.062v-1.84c-3.143-.377-4.14-2.584-4.14-2.584.806-.44.896-.347.896-.347 1.157.962 3.102 1.353 4.295.69 1.488-.823.957-2.73-1.03-3.665-2.288-1.078-4.996-2.023-4.524-5.115.343-2.247 2.37-3.414 4.503-3.722V-.001h1.983v1.654c2.616.48 3.528 2.274 3.528 2.274-.632.617-.837.545-.837.545-.92-1.025-2.618-1.32-3.738-.646-1.094.66-1.125 2.18-.088 2.87 2.316 1.542 5.285 2.057 4.542 5.438-.55 2.502-2.82 3.486-4.39 3.926v1.98h-1.999z">
                    </path>
                </svg>
                Withdrawals
            </a>
            <a href="{{ route('settings.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('settings.*') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
                Settings
            </a>
            <a href="{{ route('kyc.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('kyc.*') ? 'bg-brand-500 bg-opacity-10 text-brand-400 border border-brand-500 border-opacity-20 font-medium' : 'text-gray-400 hover:text-white hover:bg-dark-700 transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                    </path>
                </svg>
                Verification (KYC)
            </a>
        </nav>

        <div class="p-4 border-t border-dark-600">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-gray-400 hover:text-red-400 hover:bg-dark-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main
        class="flex-1 flex flex-col h-full overflow-hidden bg-[url('/images/auth-bg.png')] bg-cover bg-center bg-no-repeat relative">
        <div class="absolute inset-0 bg-dark-900 bg-opacity-80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-brand-500/10 to-transparent"></div>

        <!-- Header -->
        <header
            class="h-20 flex items-center justify-between px-6 lg:px-10 z-10 glass-panel border-b border-dark-600 shrink-0">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl font-semibold hidden sm:block">@yield('header_title')</h1>
            </div>

            <div class="flex items-center gap-6">
                <!-- Balance Display -->
                <div class="hidden sm:flex items-center gap-2 bg-dark-800 border border-dark-600 px-4 py-2 rounded-xl">
                    <span class="text-sm text-gray-400">Balance:</span>
                    <span class="font-bold text-white">${{ number_format(auth()->user()->balance ?? 0, 2) }}</span>
                </div>

                <button class="relative text-gray-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <div class="flex items-center gap-3 pl-6 border-l border-dark-600">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-brand-500 to-blue-500 p-0.5">
                        <div
                            class="w-full h-full rounded-full bg-dark-800 flex items-center justify-center text-sm font-bold">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                    <div class="hidden md:block text-sm">
                        <p class="font-semibold text-white">{{ auth()->user()->name ?? 'Alexander' }}</p>
                        <p class="text-gray-400 text-xs text-brand-400">Premium Member</p>
                    </div>
                </div>
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="pl-4 border-l border-dark-600">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-gray-400 hover:text-red-400 hover:bg-dark-700 transition-colors text-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="hidden md:inline">Logout</span>
                    </button>
                </form>
            </div>
        </header>
        <!-- Withdrawals -->
        <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if(Request::routeIs('withdrawals.*')) bg-slate-900 @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(Request::routeIs('withdrawals.*')) hover:text-slate-200 @endif"
                href="{{ route('withdrawals.index') }}">
                <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                        <path
                            class="fill-current text-slate-600 @if(Request::routeIs('withdrawals.*')) text-indigo-500 @endif"
                            d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0zm-1.07 18.062v-1.84c-3.143-.377-4.14-2.584-4.14-2.584.806-.44.896-.347.896-.347 1.157.962 3.102 1.353 4.295.69 1.488-.823.957-2.73-1.03-3.665-2.288-1.078-4.996-2.023-4.524-5.115.343-2.247 2.37-3.414 4.503-3.722V-.001h1.983v1.654c2.616.48 3.528 2.274 3.528 2.274-.632.617-.837.545-.837.545-.92-1.025-2.618-1.32-3.738-.646-1.094.66-1.125 2.18-.088 2.87 2.316 1.542 5.285 2.057 4.542 5.438-.55 2.502-2.82 3.486-4.39 3.926v1.98h-1.999z" />
                    </svg>
                    <span
                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Withdrawals</span>
                </div>
            </a>
        </li>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-6 lg:p-10 z-10 relative">
            @yield('content')
            <div class="pb-10"></div>
        </div>
    </main>

    <!-- Global Toast Notifications using Alpine.js -->
    <div x-data="{ show: false, message: '', type: 'success' }"
        x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => { show = false }, 3000)"
        class="fixed top-5 right-5 z-[60] flex flex-col gap-2">

        <div x-show="show" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 -translate-y-4 sm:-translate-y-0 sm:translate-x-4"
            x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="max-w-sm w-full shadow-lg rounded-lg pointer-events-auto overflow-hidden border"
            :class="{'bg-dark-800 border-green-500/50': type === 'success', 'bg-dark-800 border-red-500/50': type === 'error'}">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg x-show="type === 'success'" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="type === 'error'" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-white" x-text="type === 'success' ? 'Success' : 'Error'"></p>
                        <p class="mt-1 text-sm text-gray-400" x-text="message"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="show = false"
                            class="bg-dark-800 rounded-md inline-flex text-gray-400 hover:text-gray-200 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dispatch Laravel Session Messages to Alpine Toasts -->
    @if(session('success'))
        <script>
            document.addEventListener('alpine:init', () => {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: "{{ session('success') }}", type: 'success' }
                    }));
                }, 100);
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('alpine:init', () => {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: "{{ session('error') }}", type: 'error' }
                    }));
                }, 100);
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            document.addEventListener('alpine:init', () => {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: "{{ $errors->first() }}", type: 'error' }
                    }));
                }, 100);
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>