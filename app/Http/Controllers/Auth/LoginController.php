<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function loginSession(Request $req)
    {
        $user = User::where(["email" => $req->email])->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return "Username or password is not matched";
        } else {
            $req->session()->put("user", $user);
        }
        $req->session()->put("user", $user);
    }

    // public function login(Request $request)
    // {
    //     $user = User::where(["email" => $request->email])->first();

    //     $input = $request->all();
    //     $this->validate($request, [
    //         "email" => "required|email",
    //         "password" => "required",
    //     ]);
    //     if (
    //         auth()->attempt([
    //             "email" => $input["email"],
    //             "password" => $input["password"],
    //         ])
    //     ) {
    //         $request->session()->put("user", $user);
    //         if (auth()->user()->role == "admin") {
    //             return redirect()->route("index");
    //         } elseif (auth()->user()->role == "editor") {
    //             return redirect()->route("index");
    //         } else {
    //             return redirect()->route("index");
    //         }
    //     } else {
    //         // dd($user);
    //         return redirect()->route("error");
    //         // ->with("error", "Incorrect email or password");
    //     }
    // }

    public function login(Request $request)
    {
        $user = User::where(["email" => $request->email])->first();

        $input = $request->all();
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required",
        ]);

        $remember = $request->has("remember");

        if (
            auth()->attempt(
                [
                    "email" => $input["email"],
                    "password" => $input["password"],
                ],
                $remember
            )
        ) {
            $request->session()->put("user", $user);
            if (auth()->user()->role == "admin") {
                return redirect()->route("index");
            } elseif (auth()->user()->role == "editor") {
                return redirect()->route("index");
            } else {
                return redirect()->route("index");
            }
        } else {
            return redirect()->route("error");
            // ->with("error", "Incorrect email or password");
        }
    }
}
