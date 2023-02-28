<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    // => Route::get('/list/{name},'[UserController::class,'getListByName']);
    // and then in the getListByName() function we do like this:

    // getListByName($name){
    // return User::where('name',$name)->first();
    // }

    function delete($id)
    {
        $user = User::find($id);
        $result = $user->delete();
        if ($result) {
            return ["result" => "record has been deleted"];
        }
    }

    function search($name)
    {
        return User::where("username", "like", "%" . $name . "%")->get();
    }

    function update(Request $req)
    {
        $user = User::find($req->id);
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return ["Result" => "Data has been modified"];
    }

    function add(Request $req)
    {
        $user = new User();
        $user->name = "User";
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return ["Result" => "Data has been saved"];
    }

    function list($id = null)
    {
        return $id ? User::find($id) : User::all();
    }

    function login(Request $req)
    {
        $user = User::where(["email" => $req->email])->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return "Username or password is not matched";
        } else {
            $req->session()->put("user", $user);
            return redirect("/");
        }
        $req->session()->put("user", $user);
    }

    function register(Request $req)
    {
        // return $req->input();
        $user = new User();
        $user->name = "User";
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
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
}
