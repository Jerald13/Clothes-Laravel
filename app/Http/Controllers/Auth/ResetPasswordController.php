<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function rules()
    {
        return [
            "token" => "required",
            "email" => "required|email",
            "password" => "required|confirmed|min:8",
        ];
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            "email",
            "password",
            "password_confirmation",
            "token"
        );
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view("auth.passwords.reset")->with([
            "token" => $token,
            "email" => $request->email,
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with("status", trans($response))
            : back()->withErrors(["email" => trans($response)]);
    }

    public function reset(Request $request)
    {
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()
                ->route("login")
                ->with("status", trans($response));
        } else {
            return redirect()
                ->route("errors/page-404")
                ->with("status", trans($response));
        }
    }

    // public function reset(Request $request, $token)
    // {
    //     return view("auth.passwords.reset", [
    //         "token" => $token,
    //         "email" => $request->email,
    //     ]);
    // }

    public function update(Request $request)
    {
        $this->validate($request, [
            "token" => "required",
            "email" => "required|email",
            "password" => "required|confirmed|min:8",
        ]);

        $credentials = $request->only(
            "email",
            "password",
            "password_confirmation",
            "token"
        );

        $response = $this->broker()->reset($credentials, function (
            $user,
            $password
        ) {
            $this->resetPassword($user, $password);
        });

        if ($response == Password::PASSWORD_RESET) {
            return redirect()
                ->route("index")
                ->with("status", trans($response));
        } else {
            return redirect()
                ->route("SOHAIIIII")
                ->with("status", trans($response));
            // return back()->withErrors(["email" => [trans($response)]]);
        }
    }

    // public function reset(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         $this->rules(),
    //         $this->validationErrorMessages()
    //     );

    //     $credentials = $this->credentials($request);
    //     $broker = $this->broker();

    //     $response = Password::broker($broker)->reset($credentials, function (
    //         $user,
    //         $password
    //     ) {
    //         $this->resetPassword($user, $password);
    //     });

    //     if ($response === Password::PASSWORD_RESET) {
    //         return redirect()
    //             ->route("login")
    //             ->with("status", trans($response));
    //     }

    //     return back()
    //         ->withInput($request->only("email"))
    //         ->withErrors(["email" => trans($response)]);
    // }
}
