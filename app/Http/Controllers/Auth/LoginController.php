<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
	/*
                |--------------------------------------------------------------------------
                | Login Controller
                |--------------------------------------------------------------------------
                |
                | This controller handles authenticating users for the application and
                | redirecting them to your home screen. The controller uses a trait
                | to conveniently provide its functionality to your applications.
                |
    */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	/**
	 * Validate the user login request.
	 *
	 * @param Request $request
	 * @return void
	 *
	 * @throws ValidationException
	 */
	protected function validateLogin(Request $request)
	{
	    $validate_rules = [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
		$request->validate($validate_rules, validationMessage($validate_rules));
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param Request $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{

		$email_or_username = $request->email;

		$model = User::where('username', $email_or_username)->first();

		if (!$model) {
			$model = User::where('email', $email_or_username)->first();
		}

		if ($model) {
			if (!$model->is_active) {
				return ['email' => 'inactive', 'password' => 'suspend'];
			} else {
				return ['email' => $model->email, 'password' => $request->password];
			}
		} else {

			return ['email' => $email_or_username, 'password' => $request->password, 'status' => 'suspend'];
		}


	}

	/**
	 * Get the failed login response instance.
	 *
	 * @param Request $request
	 * @return Response
	 *
	 * @throws ValidationException
	 */
	protected function sendFailedLoginResponse(Request $request)
	{
		$fields = $this->credentials($request);
		if ($fields['email'] == 'inactive' && $fields['password'] == 'suspend') {
			throw ValidationException::withMessages([
				'email' => [trans('auth.suspend')],
			]);
		} else {
			throw ValidationException::withMessages([
				'email' => [trans('auth.failed')],
			]);
		}
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param Request $request
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, $user)
	{



		return response()->json(['message' => trans('auth.logged_in'), 'goto' => redirect()->intended($this->redirectPath())->getTargetUrl()]);
	}
	/**
	 * The user has logged out of the application.
	 *
	 * @param Request $request
	 * @return mixed
	 */
	protected function loggedOut(Request $request)
	{
		return response()->json(['message' => trans('auth.logged_out'), 'goto' => route('login')]);
	}
}
