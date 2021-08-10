<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.dashboard.index');
    }

    public function registeruser(Request $request)
    {
        $userino = User::where('id', $request->id)->first();

        $userino->status = 'done';
        $userino->save();

        $tenant = Tenant::where('id', $userino->domain_name)->first();

        $tenant->run(function () use ($userino) {

            // Role::create(['name' => 'boss']);
            // Role::create(['name' => 'ds']);

            $user = new User();
            $user->name = $userino->name;
            $user->email = $userino->email;
            $user->phone_no = $userino->phone_no;
            $user->nric = '1234';
            $user->password = $userino->password;
            $user->status = 'Active';
            $user->assignRole('boss');

            $user->save();
        });
        $message = "User berjaya dicipta! sila gunakan email dan password yang sama untuk login ke sistem anda.";

        return redirect()->route('dashboard.index')
            ->with('success', $message);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
