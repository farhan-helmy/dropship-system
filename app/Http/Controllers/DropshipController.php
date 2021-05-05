<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Html\Builder;

class DropshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        $dropshipper = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'nric', 'name' => 'nric', 'title' => 'NRIC'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Register Date'],
            [
                'defaultContent' => '',
                'data'           => 'action',
                'name'           => 'action',
                'title'          => 'Action',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
            ]
        ])
            ->ajax(route('dropshipper.data'));

        return view('dropshipper.index', compact('dropshipper'));
    }

    public function data()
    {
        $dropshippers = User::role('ds')->get();

        return DataTables::of($dropshippers)
            ->editColumn('action', function ($dropshippers) {
                $dropshipper =  '<div><a href="dropshipper/edit/' . $dropshippers->id . '" class="btn btn-info">Edit</a>
                <a href="dropshipper/show/' . $dropshippers->id . '" class="btn btn-success"> View</a>';
                return $dropshipper;
            })
            ->rawColumns(['action'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dropshipper.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->nric = $request->nric;
        $user->password = Hash::make($request->password);
        $user->status = 'Active';
        $user->assignRole('ds');

        $user->save();

        return redirect()->route('dropshipper.index')
            ->with('success', 'Dropshipper registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dropshipper.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dropshipper.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('dropshipper.index')
            ->with('success', 'Dropshipper updated successfully!');
    }

    public function deactivate(User $user)
    {
        $user->status = 'Inactive';

        $user->save();

        return redirect()->route('dropshipper.index')
            ->with('success', 'Dropshipper deactivated!');
    }

    public function activate(User $user)
    {
        $user->status = 'Active';

        $user->save();

        return redirect()->route('dropshipper.index')
            ->with('success', 'Dropshipper Activated!');
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
