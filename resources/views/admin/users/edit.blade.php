@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->

                <div class="container mt-4">
                    <h2 class="mb-4">تعديل صلاحيات المستخدم: {{ $user->name }}</h2>
                
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                
                        <div class="form-group">
                            <label>الصلاحيات:</label>
                            <div class="form-check">
                                @foreach($roles as $role)
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" 
                                        {{ $user->hasRole($role->name) ? 'checked' : '' }} class="form-check-input">
                                    <label class="form-check-label">{{ $role->name }}</label><br>
                                @endforeach
                            </div>
                        </div>
                
                        <button type="submit" class="btn btn-success">حفظ التغييرات</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">إلغاء</a>
                    </form>
                </div>
                
{{--  --}}
			
		<!-- main-content closed -->
@endsection
@section('js')
@endsection