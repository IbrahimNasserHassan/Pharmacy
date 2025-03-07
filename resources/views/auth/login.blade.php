@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('title')
تسجيل الدخول
@endsection
@section('content')
	    <div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/background.jpg')}}" class="my-auto ht-xxl-800p wd-md-100p wd-xxl-800p mx-auto" alt="">
						</div>
					</div>
				</div> 
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
		<div class="container p-0">
			<div class="row">
				<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
					<div class="main-card-signin d-md-flex bg-white">
						<div class="p-4 wd-100p">
							<div class="main-signin-header">
								<div class="avatar avatar-xxl avatar-xxl mx-auto text-center mb-2"><img alt="" class="avatar avatar-xxl rounded-circle  mt-2 mb-2 " src="{{URL::asset('assets/img/pharmacy.png')}}"></div>
								<div class="mx-auto text-center mt-4 mg-b-20">
									<h5 class="mg-b-10 tx-16"></h5>
									<p class="tx-13 text-muted">تسجيل الدخول </p>
								</div>

                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="mb-9">
                                                <label for="email" class="block text-sm font-larg text-gray-700"> البريد الإلكتروني </label> <br>
                                                <input id="email" type="email" name="email" required autofocus class="form-control w-full border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
                                            </div>
                                        
                                            <div class="mb-4">
                                                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label><br>
                                                <input id="password" type="password" name="password" required class="mt-1 p-3 form-control w-full border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
                                            </div>
                                        
                                            <div class="flex items-center justify-between mb-4">
                                                <label for="remember_me" class="flex items-center text-gray-700">
                                                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 border-gray-300 rounded text-green-600">
                                                    <span class="ml-2 text-sm">تذكرني</span>
                                                </label>
                                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">هل نسيت كلمة المرور؟</a>
                                            </div>
                                        
                                            <button type="submit" class="btn btn-primary">
                                                تسجيل الدخول
                                            </button>
                                        </form>
		                                    </div>
		                				</div>
		                			</div>
		                		</div>
		                	</div>
		                </div><!-- End -->
                    </div>
                </div>
            </div>
        </div>
        
					
@endsection
@section('js')
@endsection
