<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('index', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->second_name = $request->input('second_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('users')->with('status', 'User Created');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:255|unique:users,phone_number,' . $id,
            'password' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $user->first_name = $request->input('first_name');
        $user->second_name = $request->input('second_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = Hash::make($request->input('password'));

        $user->update();

        return back()->with('status', 'User Updated');
    }


    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users');
    }
}
