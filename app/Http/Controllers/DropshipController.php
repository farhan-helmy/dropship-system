<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Contracts\DataTable;
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
            ->ajax(route('admin.dropshipper.data'));

        $pending = Order::where('status', 'Pending')->count();
//dd($pending);
        return view('dropshipper.index', compact('dropshipper', 'pending'));
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
        $validated = $request->validate([
            'nric' => 'required|unique:users|max:12|min:12',
            
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->nric = $request->nric;
        $user->password = Hash::make($request->password);
        $user->status = 'Active';
        $user->assignRole('ds');

        $user->save();

        return redirect()->route('admin.dropshipper.index')
            ->with('success', 'Dropshipper registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Builder $builder)
    {
        $ordertable = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Order ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Customer Name'],
            ['data' => 'tracking_num', 'name' => 'tracking_num', 'title' => 'Tracking Num'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
        ])
            ->fixedHeader(['header' => false])
            ->ajax([
                'url' => route('admin.dropshipper.dataorder'),
                'type' => 'GET',
                'data' => 'function(d) { d.key = "' . $user->id . '"; }',
            ]);

        $pending = Order::where('status', 'Pending')->count();
        
        return view('dropshipper.show', compact('user', 'ordertable', 'pending'));
    }

    public function dataorder(Request $request)
    {
        $month = Carbon::now();
        $order = Order::where('user_id', $request->input('key'))->whereMonth('created_at', $month->format('m'))->orderBy('created_at', 'desc')->get();

        return DataTables::of($order)
            ->make();
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

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.dropshipper.index')
            ->with('success', 'Dropshipper updated successfully!');
    }

    public function deactivate(User $user)
    {
        $user->status = 'Inactive';

        $user->save();

        return redirect()->route('admin.dropshipper.index')
            ->with('success', 'Dropshipper deactivated!');
    }

    public function activate(User $user)
    {
        $user->status = 'Active';

        $user->save();

        return redirect()->route('admin.dropshipper.index')
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
