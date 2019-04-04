<?php

namespace LukaPeharda\LaravelPasswordSetup\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;

class PasswordSetupController extends BaseController
{
    use ResetsPasswords, ValidatesRequests;

    /**
     * Where to redirect users after setting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Display the form to enter password.
     *
     * @param  string $token
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showPasswordForm($token, Request $request)
    {
        $userEmailInUrl = config('laravel-password-setup.user_email_in_url');
        if ($userEmailInUrl) {
            $this->validate($request, [
                'email' => ['required', 'exists:users,email'],
            ]);
        }
        
        $email = $request->input('email');

        return view('laravel-password-setup::password', [
            'token' => $token,
            'email' => $email,
            'showEmailField' => ! $userEmailInUrl,
        ]);
    }

    /**
     * Save user password.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function savePassword(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Return URL where user will be redirected upon successfull activation
     * @return string
     */
    public function redirectPath()
    {
        return url($this->redirectTo);
    }
}
