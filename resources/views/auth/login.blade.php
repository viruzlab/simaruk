<x-guest-layout>
    <!-- Left Side - Hero with Building Image -->
    <div class="hidden lg:flex lg:w-[58%] relative overflow-hidden"
        style="background: linear-gradient(135deg, #0a1628 0%, #122044 50%, #1a2d5e 100%);">
        <!-- Background Image Overlay -->
        <div class="absolute inset-0 opacity-40"
            style="background-image: url('{{ asset('img/hero-bg.jpg') }}'); background-size: cover; background-position: center;">
        </div>

        <!-- Grid Pattern Overlay -->
        <div class="absolute inset-0"
            style="background-image: 
            linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;">
        </div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col justify-between p-10 lg:p-14 w-full">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo-white.png') }}" alt="SIMARUK" class="h-20 sm:h-24 lg:h-28 w-auto object-contain scale-110 origin-left drop-shadow-md">
            </div>

            <!-- Main Headline -->
            <div class="my-auto max-w-lg">
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6"
                    style="line-height: 1.15;">
                    Manajemen Ruangan<br>
                    Akademik dengan<br>
                    <span style="color: #7c8fff;">Presisi.</span>
                </h1>
                <p class="text-base text-blue-200/70 leading-relaxed max-w-md">
                    Akses portal manajemen ruangan terpadu untuk institusi pendidikan. Permudah penjadwalan, koordinasi
                    fasilitas kampus, dan pemberdayaan sivitas akademika.
                </p>
            </div>




        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-[42%] flex flex-col bg-white">
        <!-- Mobile Header -->
        <div class="lg:hidden bg-[#0c1a3a] p-6 text-center">
            <img src="{{ asset('img/logo-white.png') }}" alt="SIMARUK" class="h-24 sm:h-28 w-auto object-contain mx-auto scale-110 drop-shadow-md">
        </div>

        <!-- Form Area -->
        <div class="flex-1 flex flex-col justify-center px-8 sm:px-12 lg:px-14 py-12">
            <div class="w-full max-w-sm mx-auto">
                <!-- Heading -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang</h2>
                    <p class="text-sm text-gray-500">Masukkan kredensial Anda untuk mengakses portal</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Username -->
                    <div class="mb-5">
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required
                                autofocus autocomplete="username"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 focus:bg-white"
                                placeholder="Username Anda">
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-5" x-data="{ showPassword: false }">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                                autocomplete="current-password"
                                class="w-full pl-11 pr-11 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 focus:bg-white"
                                placeholder="••••••••">
                            <!-- Eye Toggle -->
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-7">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/40 focus:ring-offset-0 transition-colors">
                            <span class="ms-2 text-sm text-gray-500">Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors"
                                href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3.5 text-sm font-bold text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/25 hover:-translate-y-0.5 active:translate-y-0"
                        style="background: linear-gradient(135deg, #0c1a3a 0%, #1e3a6e 100%);">
                        <span>Masuk</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>


            </div>
        </div>

    </div>
</x-guest-layout>
