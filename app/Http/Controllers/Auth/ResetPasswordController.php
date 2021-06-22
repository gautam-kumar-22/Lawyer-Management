<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

	use ResetsPasswords;

	/**
	 * Where to redirect users after resetting their password.
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
		$this->middleware('guest');
	}

	/**
	 * Get the response for a successful password reset link.
	 *
	 * @param Request $request
	 * @param  string  $response
	 * @return RedirectResponse|JsonResponse
	 */
	protected function sendResetResponse(Request $request, $response)
	{
		return response()->json(['message' => trans($response), 'goto' => route('login')]);
		//        return back()->with('status', trans($response));
	}

	/**
	 * Get the response for a failed password reset link.
	 *
	 * @param Request $request
	 * @param string $response
	 * @return RedirectResponse|JsonResponse
	 * @throws ValidationException
	 */
	protected function sendResetFailedResponse(Request $request, $response)
	{
		if ($request->ajax()) {
			throw ValidationException::withMessages([
				'email' => [trans($response)],
			]);
		}
		return back()
			->withInput($request->only('email'))
			->withErrors(['email' => trans($response)]);
	}
}
