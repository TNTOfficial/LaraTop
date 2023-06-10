<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="login_bg d-flex justify-content-center mx-auto vh-100 align-items-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-5">
                    <div class="shadow p-2 p-md-5 mx-auto rounded" style="background-color: rgba(255,255,255, 76%);">
                        <h3 class="text-center pb-2 fw-bold">Login</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="">
                                <x-input-label for="email" :value="__('Email')" class="fw-bold" />
                                <x-text-input id="email" class="border py-2 w-100 my-2 ps-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" class="fw-bold" />
                                <x-text-input id="password" class="border py-2 w-100 my-2 ps-2" type="password" name="password" required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                    <span class="ml-2 text-sm ">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="d-flex align-items-center my-3">
                                <x-primary-button class="ml-3 btn btn-success border-0">
                                    {{ __('Log in') }}
                                </x-primary-button>
                                <div class="ms-auto">
                                    @if (Route::has('password.request'))
                                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>