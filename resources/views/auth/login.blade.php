@extends('layouts.guest', ['title' => 'Login'])

@push('css')

<style>

.login-resistration-area .main-login-area.login-res-v2::before {
    background-image: url({{ asset(config('configs')->where('key', 'login_backgroud_image')->first()->value) }})
}

.login-resistration-area .main-login-area .main-content .media-link {
    float: left;
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

			<h3 class="sho_web d-none d-md-block">Welcome back, Please login <br> to your account</h3>
			<h3 class="sho_mb d-sm-block d-md-none">Welcome To Login</h3>

			@if(Illuminate\Support\Facades\Config::get('app.app_sync'))

			@php
				$admin =  DB::table('users')->select('email')->where('role_id',1)->first();

				$lawyer =  DB::table('users')->select('email')->where('role_id',2)->first();
			@endphp

                <div class="media-link">

					@if($admin)	 
                    <form action="{{ route('login') }}" id="content_form1" class="customer-input" method="POST">
						@csrf
					            <input type="hidden" name="email" value="{{ $admin->email }}">
                                <input type="hidden" name="password" value="12345678">
								<button type="submit" name="submit" class="parents submit">Super Admin</button>  
								<button type="button" class="parents submitting" style="display:none" disabled>Loging...</button>
						</form>

						@endif

						@if($lawyer)
						<form action="{{ route('login') }}" id="content_form2" class="customer-input" method="POST">
						@csrf
					            <input type="hidden" name="email" value="{{ $lawyer->email }}">
                                <input type="hidden" name="password" value="12345678">
								<button type="submit" name="submit" class="parents submit">Lawyer</button>  
								<button type="button" class="parents submitting" style="display:none" disabled>Loging...</button>
						</form> 
						@endif
					</div>

			@endif


			<form  method="POST" action="{{ route('login') }}" id="content_form3" class="customer-input" >

			@csrf
																		
				<input required name="email" id="email" type="text" placeholder="Enter email address" autofocus class="" autocomplete="current-password"> 
				
				<input required name="password" id="password" type="password" placeholder="Password" class="" value=""> 	


				<div class="forgot-pass">
					<div class="check-remamber-field">
						<div class="round">
							<input type="checkbox" id="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
							<label for="checkbox"></label>
						</div>
						<label class="remember-me"  for="checkbox">
							Remember me
						</label>
					</div>
					<span>
						
					@if (Route::has('password.request'))
						<a href="{{ route('password.request') }}">
							{{ __('Forgot Your Password?') }}
						</a>
						@endif
				</span>
				</div>
				

				<button type="submit" class="login-res-btn submit">Login</button> 
				<button type="button" class="login-res-btn submitting" style="display:none" disabled>Loging...</button>
			</form>
			

	</div>

@endsection