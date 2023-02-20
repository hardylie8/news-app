<div class="card  card-frame  border-danger my-4">
    <div class="card-header p-0 position-relative mt-n5 mx-4 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3"> {{ __('Update Password') }}
            </h6>
            <label class="text-white mx-3">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </label>
        </div>
    </div>
    <div class="card-body px-3 pb-2">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-3">
                    <x-input-label for="current_password" :value="__('Current Password')" />
                </div>
                <div class="col-9">
                    <x-text-input id="current_password" name="current_password" type="password"
                        class="mt-1 block w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

            </div>

            <div class="row">
                <div class="col-3">
                    <x-input-label for="password" :value="__('New Password')" />
                </div>
                <div class="col-9">
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

            </div>

            <div class="row">
                <div class="col-3">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                </div>
                <div class="col-9">
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

            </div>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-9">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>

            </div>
        </form>
    </div>
</div>
