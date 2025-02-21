<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('البيانات الشخصية') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("تحديث البيانات الشخصية  ") }}
        </p>
    </header>
    <body class="bg-light">
				
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-header bg-primary text-white text-center">
                            <h4><i class="fas fa-box-setting"></i>  تعديل البيانات الشخصية </h4>
                        </div>
                        <div class="card-body p-4">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="form-lable">الإسم</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email',$user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('لم يتم التحقق من البريد الالكتروني !.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('إضغط هنا ليتم اعادة الارسال للتحقق من البريد الالكتروني') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('تحقق من بريدك الالكتروني') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <br>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('تم حفظ التغيرات') }}</p>
            @endif
        </div>
    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    
    
</section>
