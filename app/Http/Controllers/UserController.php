<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('user/user', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->is_admin == 'on' ? 1 : 0;

        $user->save();

        return redirect()->route('user.index')->with('message', 'New user create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::leftJoin('wallets', 'users.id', '=', 'wallets.user_id')
                ->select('users.*', 'wallets.wallet')
                ->where('users.id', $id)
                ->get();

        if ($user->count() < 1) {
            abort(404);
        }

        return view('user/detail', ['user' => $user[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user/edit', ['user' => $user]);
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
        $request->validate([
            'name' => 'required',
        ]);

        $user = User::find($id);
        
        $user->name = $request->name;
        $user->is_admin = $request->is_admin == 'on' ? 1 : 0;

        $user->save();

        if ($request->callback == 'user.index') {
            return redirect()->route('user.index')->with('message', 'User update successfully');
        } else if ($request->callback == 'user.show') {
            return redirect()->back()->with('message', 'User update successfully');
        } else if ($request->callback == 'profile') {
            return redirect()->back()->with('message', 'Profile update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        
        return redirect()->back()->with('message', 'User delete successfully');
    }
}
