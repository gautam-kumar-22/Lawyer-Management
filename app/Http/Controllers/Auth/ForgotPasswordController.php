<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

	use SendsPasswordResetEmails;

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
	protected function sendResetLinkResponse(Request $request, $response)
	{
		return response()->json(['message' => trans($response)]);
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
	protected function sendResetLinkFailedResponse(Request $request, $response)
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
