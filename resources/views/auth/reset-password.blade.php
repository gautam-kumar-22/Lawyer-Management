@extends('layouts.guest', ['title' => 'Reset Password'])

@push('css_after')
    <link rel="stylesheet" href="{{ asset('public/css/custom/login.css') }}"/>
@endpush

@push('css')

<style>

.login-resistration-area .main-login-area.login-res-v2::before {
    background-image: url({{ asset(config('configs')->where('key', 'login_backgroud_image')->first()->value) }})
}

</style>
@endpush

@section('content')

<div class="main-content">
		<div class="logo_img">							
			<a href="{{ route('home') }}">
				<img src="{{ asset(config('configs')->where('key', 'site_logo')->first()->value) }}" alt="Logo Image" class="img img-responsive">
			</a>
		</div> 

			<h3 class="sho_web d-none d-md-block">Reset your password</h3>

			<form  method="POST" action="{{ route('password.update') }}"  id="content_form" class="customer-input" >

			@csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input required name="email" type="text" placeholder="Enter email address" autofocus class="" autocomplete="current-password">					
				<input required name="password" type="password" placeholder="Password" id="email" autofocus class="" autocomplete="current-password"> 
				<input required name="password_confirmation" type="password" placeholder="Confirm Password" id="email" autofocus class="" autocomplete="current-password"> 
				


				<div class="forgot-pass">
						<a href="{{ route('login') }}">
							{{ __('Back to login') }}
						</a>
				</div>
				

				<button type="submit" class="login-res-btn submit">Reset Password</button> 
				<button type="button" class="login-res-btn submitting" style="display:none" disabled>Resetting Password...</button> 
			</form>

	</div>


@stop


@push('js_after')
    <script src="{{ asset('public/js/login.js') }}"></script>
@endpush


