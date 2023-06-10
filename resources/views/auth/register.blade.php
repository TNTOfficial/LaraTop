<x-guest-layout>
    <section class="login_bg1 d-flex justify-content-center mx-auto vh-100 align-items-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-5">
                    <div class="shadow p-2 p-md-5 mx-auto rounded" style="background-color: rgba(255,255,255, 76%);">
                        <h3 class="text-center pb-2 fw-bold">Sign Up</h3>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" class="fw-bold" />
                                <x-text-input id="name" class="w-100 py-2 border ps-2 my-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" class="fw-bold" />
                                <x-text-input id="email" class="w-100 py-2 border ps-2 my-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" class="fw-bold" />

                                <x-text-input id="password" class="w-100 py-2 border ps-2 my-2" type="password" name="password" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="fw-bold" />

                                <x-text-input id="password_confirmation" class="w-100 py-2 border ps-2 my-2" type="password" name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="d-flex align-items-center justify-end mt-4">
                                <x-primary-button class="ml-4 btn btn-success">
                                    {{ __('Register') }}
                                </x-primary-button>
                                <div class="ms-auto">
                                    <a class="text-decoration-none" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>