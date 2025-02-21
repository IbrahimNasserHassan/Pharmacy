<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('تغير كلمة المرور') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('اكتب كلمة مرور تسطيع تذكرها!') }}
        </p>
    </header>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center">
                        <h4><i class="fas fa-box-setting"></i>  تغير كلمة المرور  </h4>
                    </div>
                    <div class="card-body p-4">
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="form-lable">كلمة المرور الحالية</label>
            <input type="password" name="current_password" id="update_password_current_password" class="form-control" autocomplete="current-password" >
            {{-- <x-input-label for="update_password_current_password" :value="__('   ')" /> --}}
            {{-- <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="form-lable">كلمة المرور الجديدة</label>
            <input type="password" name="password" id="update_password_password" class="form-control" autocomplete="new-password">
            {{-- <x-input-label for="update_password_password" :value="__('كلمة المرور الجديدة ')" /> --}}
            {{-- <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="form-lable" >تأكيد كلمة المرور الجديدة</label>
            <input type="password" name="password_confirmation" id="update_password_password_confirmation" class="form-control" autocomplete="new-password">
            {{-- <x-input-label for="update_password_password_confirmation" :value="__('تأكيد كلمة المرور الجديدة ')" /> --}}
            {{-- <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <br>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('تم حفظ التغييرات') }}</p>
            @endif
        </div>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
