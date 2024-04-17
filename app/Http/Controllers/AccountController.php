<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public static function index()
    {
        return view('account-list', [
            'account' => Account::all()
        ]);
    }
    //login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // Authentication was successful
            $account = Auth::user();
            session(['account' => $account]);
            return redirect('/dashboard');
            // Redirect to the intended URL after successful login
        }

        // Authentication failed
        return redirect('/login')->with('error', 'Login failed'); // Redirect back to the login page if authentication fails
    }

    public function loginAccount(Request $request)
    {
        if (session()->has('account')) {
            session()->pull('account');
        }
        return redirect('/');
    }

    public function logoutAccount(Request $request)
    {
        if (session()->has('account')) {
            session()->forget('account'); // Remove the 'account' key from the session
        }
        return redirect('/'); // Redirect to the homepage or any other desired location
    }


    public static function showDetail(Account $account)
    {
        return view('profile', [
            'account' => $account
        ]);
    }

    //create
    public function create()
    {
        return view('register');
    }


    //save
    public function store(Request $request)
    {
        $valdata = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'password' => 'required'
        ]);
        $valdata['password'] = Hash::make($valdata['password']);
        Account::create($valdata);
        return redirect('/login');
    }

    //edit
    public function edit(account $account)
    {
        return view('edit', ['account' => $account]);
    }

    //update
    public function update(Request $request, Account $account)
    {
        $valdata = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'password' => 'required'
        ]);

        $account->update($valdata);

        return redirect('profile');
    }

    //delete
    public function destroy(Account $account)
    {
        Account::destroy($account->id);
        return redirect('account-list');
    }
}
