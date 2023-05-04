<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\MyNotification;
use App\Notifications\UserFollowNotification;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use Spatie\ResponseXml\ResponseFactory;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;


use Illuminate\Support\Facades\Mail;
use App\Notifications\VerifyEmail;
class UserController extends Controller
{
    function index(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(
                [
                    "message" => [
                        "These credentials do not match our records.",
                    ],
                ],
                404
            );
        }

        $token = $user->createToken("my-app-token")->plainTextToken;

        $response = [
            "user" => $user,
            "token" => $token,
        ];

        return response($response, 201);
    }

    public function display()
    {
        $users = User::where("role", 0)
            ->where("status", "active")
            ->get();

        return view("editor.user.index", compact("users"));
    }

    public function displayBannedUser()
    {
        $users = User::where("status", "Banned")->get();

        return view("editor.user.userDisplayBanned", compact("users"));
    }

    public function displayRole()
    {
        $users = User::whereIn("role", [1, 2])
            ->where("status", "Active")
            ->orderByRaw("IF(role = 2, 0, IF(role = 1, 1, 2))")
            ->get();

        return view("editor.role.index", compact("users"));
    }

    function search($name)
    {
        return User::where("username", "like", "%" . $name . "%")->get();
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            "username" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                Rule::unique("users")->ignore($user->id),
            ],
            "phone_number" => ["required", "string", "max:20"],
        ]);

        $user->update($validatedData);
        session()->flash("success", $user->username . " account updated.");
        return redirect("/profile");
    }

    function list($id = null)
    {
        return $id ? User::find($id) : User::all();
    }

    // function login(Request $req)
    // {
    //     $user = User::where(["email" => $req->email])->first();
    //     if (!$user || !Hash::check($req->password, $user->password)) {
    //         return "Username or password is not matched";
    //     } else {
    //         $req->session()->put("user", $user);
    //         return redirect("/");
    //     }
    //     $req->session()->put("user", $user);
    // }

    function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "username" => "required|unique:users",
            "email" => "required|unique:users|email|max:255",
            "phone_code" => "required",
            "phone_number" => "required",
            "password" => "required|min:6",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $user = new User();
        $user->name = "User";
        $user->username = $req->username;
        $user->email = $req->email;
        $user->phone_number = $req->phone_code . $req->phone_number;

        $user->password = Hash::make($req->password);
        $user->save();

        //     //This line of Code is Send SMS Notification from Vonage to User Phone number exactly
        // $user->notify(new MyNotification());

        return redirect("/login");
    }

    function testData(Request $req)
    {
        $rules = [
            "id" => "required|min:2|max:4",
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $result = $user->save();
            if ($result) {
                return ["Result" => "Data has been modified"];
            } else {
                return ["Result" => "failed"];
            }
        }
    }

    public function profile()
    {
        $user = auth()->user();
        return view("profile", compact("user"));
    }

    public function displayInXSL()
    {
        $users = User::latest()->paginate(10);

        $xml = new \SimpleXMLElement("<users/>");

        foreach ($users as $user) {
            $userXml = $xml->addChild("user");
            $userXml->addChild("id", $user->id);
            $userXml->addChild("name", $user->name);
            $userXml->addChild("username", $user->username);
            $userXml->addChild("email", $user->email);
            $userXml->addChild("phone_number", $user->phone_number);
        }

        $xmlString = $xml->asXML();

        // Load the XSL stylesheet
        $xsl = new \DOMDocument();
        $xsl->load(base_path("resources/views/editor/User/index.xsl"));

        // Load the XML data
        $xmlData = new \DOMDocument();
        $xmlData->loadXML($xmlString);

        // Apply the XSL transformation
        $xsltProcessor = new \XSLTProcessor();
        $xsltProcessor->importStylesheet($xsl);
        $htmlString = $xsltProcessor->transformToXML($xmlData);

        // Create and return the response
        $response = new Response($htmlString);
        $response->header("Content-Type", "text/html");

        return $response;
    }

    public function displayInXML()
    {
        $users = User::latest()->paginate(10);

        $xml = new \SimpleXMLElement("<users/>");

        foreach ($users as $user) {
            $userXml = $xml->addChild("user");
            $userXml->addChild("id", $user->id);
            $userXml->addChild("name", $user->name);
            $userXml->addChild("username", $user->username);
            $userXml->addChild("email", $user->email);
            $userXml->addChild("phone_number", $user->phone_number);
        }

        $xmlString = $xml->asXML();

        $response = new Response($xmlString);
        $response->header("Content-Type", "application/xml");

        return $response;
    }

    public function exportUsersToXml()
    {
        $users = User::all();

        $xml = new \SimpleXMLElement("<users/>");
        foreach ($users as $user) {
            $userXml = $xml->addChild("user");
            $userXml->addChild("id", $user->id);
            $userXml->addChild("name", $user->name);
            $userXml->addChild("email", $user->email);
        }

        $response = response($xml->asXML(), 200);
        $response->header("Content-Type", "text/xml");
        $response->header(
            "Content-Disposition",
            'attachment; filename="users.xml"'
        );

        return $response;
    }
    public function importUsersToXml(Request $request)
    {
        $xmlFile = $request->file("xmlFile");

        $xmlString = file_get_contents($xmlFile);

        $xml = new \SimpleXMLElement($xmlString);

        foreach ($xml->user as $userData) {
            $user = new User();
            // $user->name = (string) $userData->name;
            $user->name = "User";
            $user->username = (string) $userData->username;
            $user->email = (string) $userData->email;
            $user->phone_number = (string) $userData->phone_number;
            $user->status = (string) $userData->status;
            $user->password = Hash::make((string) $userData->password);
            $user->role = 0;
            $user->save();
        }
        return redirect()
            ->back()
            ->with("success", "Users imported successfully.");
    }

    public function banUser(User $user)
    {
        $user->status = "Banned";
        $user->save();

        return redirect()
            ->back()
            ->with("success", "User has been banned.");
    }

    public function unbanUser(User $user)
    {
        $user->status = "Active";
        $user->save();
        return redirect()
            ->back()
            ->with("success", "User has been banned.");
    }

    // public function verify(Request $request)
    // {
    //     // get the user from the request
    //     $user = User::findOrFail($request->id);

    //     // check if the user has already been verified
    //     if ($user->hasVerifiedEmail()) {
    //         return response()->json(
    //             ["errors" => ["message" => "Email address already verified."]],
    //             422
    //         );
    //     }

    //     $hash = sha1($user->email . $user->created_at . config("app.key"));

    //     $verificationUrl = URL::temporarySignedRoute(
    //         "auth.verify",
    //         now()->addMinutes(60),
    //         ["id" => $user->id, "hash" => $hash]
    //     );

    //     // send the verification email to the user
    //     Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

    //     // mark the user as verified and update the email_verified_at column
    //     $user->markEmailAsVerified();
    //     $user->email_verified_at = now();
    //     $user->save();

    //     return response()->json([
    //         "message" =>
    //             "A verification email has been sent to your email address.",
    //     ]);
    // }

    public function sendVerificationEmail(Request $request)
    {
        // get the user from the request
        $user = User::findOrFail($request->id);

        // check if the user has already been verified
        if ($user->hasVerifiedEmail()) {
            return response()->json(
                ["errors" => ["message" => "Email address already verified."]],
                422
            );
        }

        // generate the verification URL
        $hash = sha1($user->email . $user->created_at . config("app.key"));
        $verificationUrl = URL::temporarySignedRoute(
            "auth.verify",
            now()->addMinutes(60),
            ["id" => $user->id, "hash" => $hash]
        );

        // send the verification email to the user
        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        return response()->json([
            "message" =>
                "A verification email has been sent to your email address.",
        ]);
    }

    public function verify(Request $request)
    {
        // check if the url is a valid signed url
        // if (!URL::hasValidSignature($request)) {
        //     return response()->json(
        //         [
        //             "errors" => [
        //                 "message" => "Invalid verification link or signature.",
        //             ],
        //         ],
        //         422
        //     );
        // }

        // get the user from the request
        $user = User::findOrFail($request->id);

        // check if the user has already been verified
        if ($user->hasVerifiedEmail()) {
            return response()->json(
                ["errors" => ["message" => "Email address already verified."]],
                422
            );
        }

        // mark the user as verified and update the email_verified_at column
        // $user->markEmailAsVerified();
        $user->username = "1";
        $user->save();

        return response()->json([
            "message" => "Email address has been verified.",
        ]);
    }
}
