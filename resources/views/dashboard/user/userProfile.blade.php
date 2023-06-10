@extends('layouts.admin.master')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('content')
<section>
    <div class="container">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 fw-bold">
                {{ __("Update your account's profile information.") }}
            </p>
        </header>
        <div class="shadow p-2 p-md-5 bg-white rounded">
            <div class="row g-3 justify-content-center">
                <div class="col-lg-4 col-md-12">
                    <div class="text-center pt-3">
                        @if ($userProfile)
                        <img src="{{ asset('storage/images/' . $userProfile->img) }}" alt="img" class="rounded object-fit-cover" style="width:200px; height:200px">
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <form method="post" action="{{ route('user_profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="">

                            <div>
                                <x-input-label class="fw-medium" for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="w-100 border rounded py-3 ps-2 my-2" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label class="fw-medium" for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="w-100 border rounded py-3 ps-2 my-2" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label class="fw-medium" for="address" :value="__('Address')" />
                                <x-text-input id="address" name="address" type="text" class="w-100 border rounded py-3 ps-2 my-2" :value="old('address', optional($userProfile)->address)" required autofocus autocomplete="address" />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <div>
                                <x-input-label class="fw-medium" for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="number" class="w-100 border rounded py-3 ps-2 my-2" :value="old('phone', optional($userProfile)->phone)" required autofocus autocomplete="phone" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-input-label class="fw-medium" for="image" :value="__('User Image')" />
                                <input id="image-file" name="image" type="file" class="w-100 border rounded my-2" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                <div class="col-md-12 mb-2">
                                    <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                                </div>
                            </div>

                            <input type="hidden" id="croppedImage" name="croppedImage" />
                            <div class="flex items-center gap-4">
                                <x-primary-button class="btn btn-primary my-3">{{ __('Save') }}</x-primary-button>

                                @if (session('status'))
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ session('status') }}</p>
                                @endif

                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

</section>
@include('components.cropper', ['imageId' => 'image', 'aspect_ratio' => '1'])
@endsection
@section('script')
@stack('scripts')
@endsection