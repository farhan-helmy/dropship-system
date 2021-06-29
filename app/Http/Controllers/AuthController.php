<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $test = Auth::attempt($credentials);
        // dd($test);\
        if (Auth::attempt($credentials)) {

            $user = User::where('email', $request->email)->first();

            //SELECT * FROM users WHERE 'email' LIKE 'afifah@gmail.com' LIMIT 1;

            $roles = $user->getRoleNames();

            if ($roles[0] === "boss") {
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard.index');
            } else if ($roles[0] === "ds") {
                $request->session()->regenerate();

                return redirect()->route('ds.dashboard.index');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }
}
