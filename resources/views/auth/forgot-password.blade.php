@extends('layouts.guest', ['title' => 'Forgot Password'])

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

			<h3 class="sho_web d-none d-md-block">Forgot your password?</h3>

            <p> {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
			
			



			<form  method="POST" action="{{ route('password.email') }}"  id="content_form" class="customer-input" >

			@csrf
																		
				<input required name="email" type="text" placeholder="Enter email address" id="email" autofocus class="" autocomplete="current-password"> 
				


				<div class="forgot-pass">
						<a href="{{ route('login') }}">
							{{ __('Back to login') }}
						</a>
				</div>
				

				<button type="submit" class="login-res-btn submit">Send Instruction</button> 
				<button type="button" class="login-res-btn submitting" style="display:none" disabled>Sending Instructions...</button> 
			</form>
			

	</div>

    
    
@stop


@push('js_after')

@endpush

