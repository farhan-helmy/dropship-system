<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

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
        $user = User::where('id', $request->id)->first();

        $user->status = 'done';
        $user->save();

        $tenant = Tenant::where('id', $user->domain_name)->first();

        $tenant->run(function () {
            
            Role::create(['name' => 'boss']);
            Role::create(['name' => 'ds']);

            $user = new User();
            $user->name = 'mainuser';
            $user->email = 'testemail@penguindropship.com';
            $user->phone_no = 'Please update your phone number';
            $user->nric = '1234';
            $user->password = Hash::make('password');
            $user->status = 'Active';
            $user->assignRole('boss');

            $user->save();
        });

        return redirect()->route('dashboard.index')
            ->with('success', 'Pengguna sistem anda telah di cipta Username: testemail@penguindropship.com password: password ');
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
