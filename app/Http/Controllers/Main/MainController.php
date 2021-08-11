<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Mail\VerifyUser;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.landing.index');
    }

    public function register()
    {
        return view('main.register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function testmail()
    {
        Mail::to('farhanhlmy@gmail.com')->send(new VerifyUser('testing123'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|integer',
            'password' => 'required|min:8',
            'domainname' => 'required|unique:users,domain_name',
            'domainname' => 'required|unique:tenants,id',
        ]);
        //dd($data);
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->password = Hash::make($request->password);
        $user->status = 'unverified';
        $user->domain_name = $request->domainname;
        $user->save();

        $link = 'http://penguindropship.com/verify/' . $user->id;

        Mail::to($request->email)->send(new VerifyUser($link));

        $tenant = Tenant::create(['id' => $request->domainname]);
        $tenant->domains()->create(['domain' => $request->domainname . '.penguindropship.com']);

        return redirect()->route('verify')
            ->with('success', 'Please verify your email.');
    }

    public function verify($id)
    {
        $user = User::where('id', $id)->first();

        $user->status = 'verified';
        $user->email_verified_at = Carbon::now();
        $user->save();

        //dd($user);
        return redirect()->route('login')
        ->with('success', 'Email verified please login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->status == 'unverified') {
            return back()->withErrors([
                'email' => 'Email tidak di verifikasi, sila semak email.',
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
