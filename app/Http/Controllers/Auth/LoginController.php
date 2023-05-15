<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Strategy\UsernameAuth;
use App\Strategy\EmailAuth;
use App\Strategy\UserAuthContext;

use Illuminate\Support\Facades\Session;
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

    public function login(Request $request)
    {
        $this->validate($request, [
            "email" => "required",
            "password" => "required",
        ]);

        // Get the number of login attempts
        $loginAttempts = $request->session()->exists("login_attempts")
            ? $request->session()->get("login_attempts")
            : 0;

        $remember = $request->has("remember");
        $emailOrUsername = $request->input("email");

        if (filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)) {
            $strategy = new EmailAuth();
        } else {
            $strategy = new UsernameAuth();
        }

        $authContext = new UserAuthContext($strategy);
        $user = $authContext->authenticateUser(
            $request->input("email"),
            $request->input("password"),
            $remember
        );
        if ($user != null) {
            if ($user->status === "Banned") {
                auth()->logout();
                return redirect()
                    ->route("errors/page-error")
                    ->with([
                        "error" => "Your account has been banned.",
                        "No" => "403",
                    ]);
            }

            $request->session()->put("user", $user);
            $request->session()->put("login_attempts", 0);
            return redirect()->route("getAllProductIndex");
        } else {
            // return redirect()
            //     ->route("errors/page-404")
            //     ->with("message", "Incorrect email or password");
            // Authentication failed

            // Get the number of login attempts
            $loginAttempts = $request->session()->exists("login_attempts")
                ? $request->session()->get("login_attempts")
                : 0;

            // Increment the login attempts counter
            $loginAttempts++;

            // Put the updated value back in the session
            $request->session()->put("login_attempts", $loginAttempts);

            // Check if the user has exceeded the maximum number of login attempts (in this case 5)
            if ($loginAttempts >= 5) {
                return redirect()
                    ->route("login")
                    ->with([
                        "loginError" =>
                            "You have attempted 5 times, Kindly wait 2 hours and try again.",
                        "email" => $request->input("email"),
                    ]);
            }

            return redirect()
                ->route("login")
                ->with([
                    "loginError" =>
                        "These credentials do not match our records.",
                    "email" => $request->input("email"),
                ]);
        }
    }

    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         "email" => "required|email",
    //         "password" => "required",
    //     ]);

    //     $remember = $request->has("remember");

    //     if (
    //         auth()->attempt(
    //             ["email" => $request->email, "password" => $request->password],
    //             $remember
    //         )
    //     ) {
    //         $user = $request->user();
    //         if ($user->status === "Banned") {
    //             auth()->logout();
    //             return redirect()
    //                 ->route("errors/page-error")
    //                 ->with([
    //                     "error" => "Your account has been banned.",
    //                     "No" => "403",
    //                 ]);
    //         }

    //         $request->session()->put("user", $user);

    //         if ($user->role == "admin" || $user->role == "editor") {
    //             return redirect()->route("index");
    //         } else {
    //             return redirect()->route("index");
    //         }
    //     } else {
    //         return redirect()
    //             ->route("errors/page-404")
    //             ->with("message", "Incorrect email or password");
    //     }
    // }

    // public function login(Request $request)
    // {
    //     $user = User::where("email", $request->email)->first();

    //     // Check if user is banned
    //     if ($user && $user->status === "Banned") {
    //         return redirect()
    //             ->route("errors/page-error")
    //             ->with([
    //                 "error" => "Your account has been banned.",
    //                 "No" => "403",
    //             ]);
    //     }

    //     $input = $request->all();
    //     $this->validate($request, [
    //         "email" => "required|email",
    //         "password" => "required",
    //     ]);

    //     $remember = $request->has("remember");

    //     if (
    //         auth()->attempt(
    //             ["email" => $input["email"], "password" => $input["password"]],
    //             $remember
    //         )
    //     ) {
    //         $cart = Cart::with("products")
    //             ->where("user_id", $user->id)
    //             ->first();
    //         Session::put("cart", $cart);
    //         $request->session()->put("user", $user);

    //         if (auth()->user()->role == "admin") {
    //             return redirect()->route("index");
    //         } elseif (auth()->user()->role == "editor") {
    //             return redirect()->route("index");
    //         } else {
    //             return redirect()->route("index");
    //         }
    //     } else {
    //         return redirect()
    //             ->route("errors/page-404")
    //             ->with("message", "Incorrect email or password");
    //     }
    // }
}
